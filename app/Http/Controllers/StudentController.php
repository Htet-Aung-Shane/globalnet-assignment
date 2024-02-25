<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserUpdateRequest;

class StudentController extends Controller
{
    //
    public function index(Request $request): View
    {
        $student = Student::paginate(5);
        $studentCount = Student::count();
        return view('student.index',[
            'students' => $student ,
            'student_count' => $studentCount, 
        ]);

    }

    public function create(Request $request): View
    {
        return view('student.create');
        
    }

    public function edit(Request $request): View
    {
            $student =DB::select('select * from students where id = :id', ['id' => $request['id']]);
            return view('student.edit',[
                'student' => $student,
            ]);
        
    }
    public function createAction(Request $request): RedirectResponse
    {   
        $rules = [
            'name' => ['required','string','max:255'],
            'fname' => ['required','string','max:255'],
            'phone' => ['required','string','max:255'],
            'roll_no' => ['required','string','max:255'], 
            'class' => ['required','string','max:255'],      
            'nrc' => ['required','string','max:255'], 
            'address' => ['required','string','max:255'],         
            'dob' => ['required', 'date'],
        ];

        $messages = [
            'name.required' => 'The user name is required',
            'fame.required' => 'The father name is required',
            'phone.required' => 'The phone number is required',
            'roll_no.required' => 'The roll no is required',
            'class.required' => 'The father name is required',
            'nrc.required' => 'NRC is required',
            'address.required' => 'The address is required',
            'dob.required' => 'DOB is required',
            'address.date' => 'DOB is not date format',
            
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        // Validation passed, create the user account
        Student::create([
            'name' => $request->input('name'),
            'father_name' => $request->input('fname'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'roll_no' => $request->input('roll_no'),
            'class' => $request->input('class'),
            'dob' => $request->input('dob'), 
            'nrc' => $request->input('nrc'),
        ]);

        // Redirect the user after successful account creation
        return redirect()->route('student.list')->with('success', 'Student created successfully.');      
            
    }
    public function update(Request $request): RedirectResponse{
        
        $rules = [
            'name' => ['required','string','max:255'],
            'fname' => ['required','string','max:255'],
            'phone' => ['required','string','max:255'],
            'roll_no' => ['required','string','max:255'], 
            'class' => ['required','string','max:255'],      
            'nrc' => ['required','string','max:255'], 
            'address' => ['required','string','max:255'],         
            'dob' => ['required', 'date'],
        ];

        $messages = [
            'name.required' => 'The user name is required',
            'fame.required' => 'The father name is required',
            'phone.required' => 'The phone number is required',
            'roll_no.required' => 'The roll no is required',
            'class.required' => 'The father name is required',
            'nrc.required' => 'NRC is required',
            'address.required' => 'The address is required',
            'dob.required' => 'DOB is required',
            'address.date' => 'DOB is not date format',
            
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $student = Student::find($request['id']);
        $student->name = $request->input('name');
        $student->father_name = $request->input('fname');
        $student->phone = $request->input('phone');
        $student->address = $request->input('address');
        $student->roll_no = $request->input('roll_no');
        $student->dob = $request->input('dob');
        $student->nrc = $request->input('nrc');      
        $student->save();
        return redirect()->route('student.list')->with('success', 'Student '. $student->name .' was updated.');
    }

    public function deleteAction(Request $request): RedirectResponse{

        $student = Student::find($request['id']);
        if (!$student) {
            return back()->with('error', 'Student not found.');
        }
        $studentName = $student->name;
        $student->delete();
        return back()->with('success','Student '.$studentName.' deleted successfully.');
    }
}
