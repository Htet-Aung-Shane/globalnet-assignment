<!-- create.blade.php -->
@extends('dashboard')

@section('content')
<div class="p-8">
    <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Edit User') }}
    </h2> <!-- Breadcrumb -->
    <nav class="flex px-2 py-2 text-gray-700" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('student.list') }}"
                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                        Student
                    </a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                        Edit
                    </span>
                </div>
            </li>
        </ol>
    </nav>
    <div class="mr-auto mt-4 bg-gray-800 shadow-lg rounded-lg p-16">
        @foreach($student as $student)
        <form action="{{ route('student.edit.action') }}" method="POST">
            {{-- name --}}
            @csrf
            @method('patch')
            <input type="text" id="id" name="id" required class="hidden" @if(isset($student->id))
            value="{{ $student->id }}"
            @endif
            >
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name <span
                    class="text-red-500">*</span> </label>
            <div class="flex">
                <span
                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    <x-heroicon-o-user-plus class="h-4 w-4 ml-1 mr-2" />
                </span>
                <input type="text" id="name" name="name" required
                    class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    @if(isset($student->name))
                value="{{ $student->name }}"
                @else
                placeholder="Mg Mg"
                @endif
                >
            </div>

            {{-- fathername --}}
            <label for="fname" class="block mb-2 mt-3 text-sm font-medium text-gray-900 dark:text-white">Father Name
                <span class="text-red-500">*</span> </label>
            <div class="flex">
                <span
                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    <x-heroicon-o-user-circle class="h-4 w-4 ml-1 mr-2" />
                </span>
                <input type="text" id="fname" name="fname" required
                    class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    @if(isset($student->father_name))
                value="{{ $student->father_name }}"
                @else
                placeholder="Mg Mg"
                @endif
                >
            </div>
            @error('fname')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            {{-- phone --}}
            <label for="phone" class="block mb-2 mt-3 text-sm font-medium text-gray-900 dark:text-white">Phone <span
                    class="text-red-500">*</span></label>
            <div class="flex">
                <span
                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    <x-heroicon-o-user-group class="h-4 w-4 ml-1 mr-2" />
                </span>
                <input type="text" id="phone" name="phone"
                    class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    @if(isset($student->phone))
                value="{{ $student->phone }}"
                @else
                placeholder="Mg Mg"
                @endif
                >
            </div>
            @error('phone')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            {{-- roll no --}}
            <label for="roll_no" class="block mb-2 mt-3 text-sm font-medium text-gray-900 dark:text-white">Roll No <span
                    class="text-red-500">*</span></label>
            <div class="flex">
                <span
                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    <x-heroicon-o-user-group class="h-4 w-4 ml-1 mr-2" />
                </span>
                <input type="text" id="roll_no" name="roll_no"
                    class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    @if(isset($student->roll_no))
                value="{{ $student->roll_no }}"
                @else
                placeholder="Mg Mg"
                @endif
                >
            </div>
            @error('roll_no')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            {{-- class --}}
            <label for="class" class="block mb-2 mt-3 text-sm font-medium text-gray-900 dark:text-white"> Class <span
                    class="text-red-500">*</span></label>
            <div class="flex">
                <span
                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    <x-heroicon-o-user-group class="h-4 w-4 ml-1 mr-2" />
                </span>
                <input type="text" id="class" name="class"
                    class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    @if(isset($student->class))
                value="{{ $student->class }}"
                @else
                placeholder="Mg Mg"
                @endif
                >
            </div>
            @error('class')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            {{-- dob --}}
            <label for="class" class="block mb-2 mt-3 text-sm font-medium text-gray-900 dark:text-white"> DOB <span
                    class="text-red-500">*</span></label>
            <div class="flex">
                <span
                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    <x-heroicon-o-user-group class="h-4 w-4 ml-1 mr-2" />
                </span>
                <input datepicker type="text" id="dob" name="dob"
                    class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    @if(isset($student->dob))
                value="{{ $student->dob }}"
                @else
                placeholder="Mg Mg"
                @endif
                >
            </div>
            @error('dob')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            {{-- nrc --}}
            <label for="class" class="block mb-2 mt-3 text-sm font-medium text-gray-900 dark:text-white"> NRC <span
                    class="text-red-500">*</span></label>
            <div class="flex">
                <span
                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    <x-heroicon-o-user-group class="h-4 w-4 ml-1 mr-2" />
                </span>
                <input type="text" id="nrc" name="nrc"
                    class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    @if(isset($student->nrc))
                value="{{ $student->nrc }}"
                @else
                placeholder="Mg Mg"
                @endif
                >
            </div>
            @error('nrc')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            {{-- address --}}
            <label for="address" class="block mb-2 mt-3 text-sm font-medium text-gray-900 dark:text-white">Address <span
                    class="text-red-500">*</span> </label>
            <div class="flex">
                <span
                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    <x-heroicon-o-at-symbol class="h-4 w-4 ml-1 mr-2" />
                </span>
                <input type="text" id="address" name="address" required
                    class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    @if(isset($student->nrc))
                value="{{ $student->nrc }}"
                @else
                placeholder="Mg Mg"
                @endif
                >

            </div>
            @error('address')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror


            {{-- submit --}}
            <x-primary-button class="ms-2 mt-4">
                {{ __('Submit') }}
            </x-primary-button>
        </form>
        @endforeach
    </div>
</div>

@endsection