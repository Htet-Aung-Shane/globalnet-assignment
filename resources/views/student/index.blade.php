<!-- index.blade.php -->
@extends('dashboard')

@section('content')
@if (session('success'))
<div id="alertBox" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
    <strong class="font-bold">Success!</strong>
    <span class="block sm:inline">{{ session('success') }}</span>
    <span id="closeButton" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
        <svg class="fill-current h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <title>Close</title>
            <path fill-rule="evenodd"
                d="M14.95 5.64a1 1 0 0 1 1.41 1.41l-9.19 9.18a1 1 0 0 1-1.41-1.41l9.19-9.18a1 1 0 0 1 0 0z" />
            <path fill-rule="evenodd"
                d="M5.05 5.64a1 1 0 0 1 0 1.41l9.19 9.18a1 1 0 0 1-1.41 1.41l-9.19-9.18a1 1 0 0 1 1.41-1.41z" />
        </svg>
    </span>
</div>
@endif
@if (session('fail'))
<div id="alertBox" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
    <strong class="font-bold">Warning!</strong>
    <span class="block sm:inline">{{ session('fail') }}</span>
    <span id="closeButton" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
        <svg class="fill-current h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <title>Close</title>
            <path fill-rule="evenodd"
                d="M14.95 5.64a1 1 0 0 1 1.41 1.41l-9.19 9.18a1 1 0 0 1-1.41-1.41l9.19-9.18a1 1 0 0 1 0 0z" />
            <path fill-rule="evenodd"
                d="M5.05 5.64a1 1 0 0 1 0 1.41l9.19 9.18a1 1 0 0 1-1.41 1.41l-9.19-9.18a1 1 0 0 1 1.41-1.41z" />
        </svg>
    </span>
</div>
@endif
<div class="p-8">
    <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Student Management') }}
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
                        List
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="flex mt-6">
        <div class="relative flex flex-col text-gray-700 bg-white shadow-md bg-clip-border rounded-xl w-96 mr-4">
            <div class="p-6">
                <x-heroicon-o-rocket-launch class="w-12 h-12 mb-4 text-gray-900" />
                <h5
                    class="block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    Total Student
                </h5>
                <p
                    class="block font-sans text-base antialiased font-light leading-relaxed text-inherit flex items-center">
                    Great, we have <span class='font-bold ml-2'>{{ $student_count }}</span>
                    <x-heroicon-o-user-group class="h-4 w-4 ml-1 mr-2" />
                    total student
                </p>
            </div>
            <div class="p-6 pt-0">
                <a href="{{ route('student.create') }}" class="inline-block">
                    <button
                        class="flex items-center gap-2 px-4 py-2 font-sans text-xs font-bold text-center text-gray-900 uppercase align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20"
                        type="button">
                        Create The Student
                        <x-heroicon-o-arrow-right-end-on-rectangle class="h-4 w-4 ml-auto mr-2" />
                    </button>
                </a>
            </div>
        </div>


    </div>

    {{-- data --}}

    <form class="max-w-md mx-auto mt-4 mr-0" action="{{ route('student.list') }}">
        <label for="default-search" class=" text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" id="search" name="search"
                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search Name, Father Name, Phone Number" required />
            <button type="submit"
                class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </form>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Father Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Phone No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Address
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Roll No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Class
                    </th>
                    <th scope="col" class="px-6 py-3">
                        DOB
                    </th>
                    <th scope="col" class="px-6 py-3">
                        NRC
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($students)
                @foreach ($students as $student)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-1" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $student->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $student->father_name }}
                    </td>
                    <td class="px-6 py-4">
                        <span class='text-green-600'> {{ $student->phone }} </span>
                    </td>
                    <td class="px-6 py-4">
                        {{ $student->address }}
                    </td>
                    <td class="px-6 py-4">
                        <span class='text-yellow-600'> {{ $student->roll_no }} </span>
                    </td>
                    <td class="px-6 py-4">
                        {{ $student->class }}
                    </td>
                    <td class="px-6 py-4">
                        <span class='text-blue-600'> {{ $student->dob }} </span>
                    </td>
                    <td class="px-6 py-4">
                        {{ $student->nrc }}
                    </td>
                    <td class="flex items-center px-6 py-4">
                        <a href="{{ route('student.edit') }}?id={{ $student->id }}"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        <a href="{{ route('student.delete') }}?id={{ $student->id }}"
                            class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Remove</a>
                    </td>
                </tr>
                @endforeach
                @endif

            </tbody>
        </table>
    </div>
    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $students->links() }}
    </div>


    @endsection