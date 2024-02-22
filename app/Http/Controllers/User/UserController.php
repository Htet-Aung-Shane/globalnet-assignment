<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserUpdateRequest;


class UserController extends Controller
{
    //
    public function index(Request $request): View
    {
        $users = User::paginate(5);
        $userCount = User::count();
        $userAdminCount = User::where('is_admin', 1)->count();
        return view('user.index',[
            'users' => $users ,
            'user_count' => $userCount, 
            'user_admin_count' => $userAdminCount
        ]);

    }
    public function create(Request $request): View
    {
        return view('user.create');
        
    }

    public function edit(Request $request): View
    {
            $user =DB::select('select * from users where id = :id', ['id' => $request['id']]);
            return view('user.edit',[
                'user' => $user,
            ]);
        
    }
    public function createAction(Request $request): RedirectResponse
    {   
        $rules = [
            'name' => ['required','string','max:255'],
            'uname' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9_]+$/u ', // Allow only letters, numbers, and underscores
                'unique:users',
            ],
            'email' => ['required','email','unique:users'],
            'password' => ['required','string','min:8','confirmed'],
            'phone' => [
                'nullable',
                'string',
                'max:20', // Adjust the max length as needed
                'regex:/^[0-9()+\-. ]+$/', // Adjust the regex pattern as needed
            ],
        ];

        $messages = [
            'password.confirmed' => 'The password confirmation does not match.',
            'password.min' => 'The password must be at least 8 characters.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'The email address has already been taken.',
            'uname.unique' => 'The user name has already been taken.',
            'uname.regex' => 'The user name does not allow special characters, space and script',
            
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        // Validation passed, create the user account
        User::create([
            'name' => $request->input('name'),
            'uname' => $request->input('uname'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'is_active' => $request->has('is_active') ? true : false , 
            'is_admin' => $request->has('is_admin') ? true : false ,  
        ]);

        // Redirect the user after successful account creation
        return redirect()->route('user.list')->with('success', 'User created successfully.');      
            
    }
    public function update(UserUpdateRequest $request): RedirectResponse{
        $user = User::find($request['id']);
        if($request['is_active'])
            $user->is_active = true;
        else
            $user->is_active = false;
        if($request['is_admin'])
            $user->is_admin = true;
        else
            $user->is_admin = false;
        $user->fill($request->validated());
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        } 
        $user->save();
        return redirect()->route('user.list')->with('success', 'User '. $request->user()->name .' was updated.');
    }

    
    public function editAction(Request $request): RedirectResponse{

        $userori = User::find($request['id']);
        if (!$userori) {
            return back()->with('error', 'User not found.');
        }
        $userName = $userori->name;
        $rules = [
            'name' => 'required|string|max:255',
            'uname' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9_]+$/u',
                Rule::unique('users')->ignore($userori->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($userori->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => [
                'string',
                'max:20', // Adjust the max length as needed
                'regex:/^[0-9()+\-. ]+$/', // Adjust the regex pattern as needed
            ],
        ];     
        $messages = [
            'password.confirmed' => 'The password confirmation does not match.',
            'password.min' => 'The password must be at least 8 characters.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'The email address '. $request->input('email') .' has already been taken.',
            'uname.unique' => 'The user name '. $request->input('uname') .'  has already been taken.',
            'uname.regex' => 'The user name does not allow special characters, space and script',
            'phone.regex' => 'Phone number does not match the pattern. ',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $user = $request->user();
        if ($request->input('name') != $userori->name)
            $user->name = $request->input('name');
        if ($request->input('uname') != $userori->uname)
            $user->uname = $request->input('uname');
        if ($request->input('email') != $userori->email)
            $user->email = $request->input('email');
        if ($request->has('phone')) {
            $user->phone = $request->input('phone');
        }
        if ($request->has('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        if ($request->has('is_active'))
            $is_active = 1;
        else
            $is_active = 0;
        if ($request->has('is_admin'))
            $is_admin = 1;
        else
            $is_admin = 0;


        if ($is_active != $userori->is_active ) {
            if ($request->has('is_active'))
                $user->is_active = TRUE;
            else
                $user->is_active = FALSEt;
        }

        if ($is_admin != $userori->is_admin ) {
            if ($request->has('is_admin'))
                $user->is_admin = TRUE;
            else
                $user->is_admin = FALSE;
        }
        $user->save();
        return redirect()->route('user.list')->with('success', 'User '. $userName .' was updated.');
    }

    public function deleteAction(Request $request): RedirectResponse{

        $user = User::find($request['id']);
        if (!$user) {
            return back()->with('error', 'User not found.');
        }
        $userName = $user->name;
        if ($user->id === Auth::id()) {
            return back()->with('fail','Deleted user '.$userName.' is current logged in.');
        }
        $user->delete();
        return back()->with('success','User '.$userName.' deleted successfully.');
    }

        
}
