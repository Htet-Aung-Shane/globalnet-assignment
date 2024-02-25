<x-app-layout>
        <x-slot name="header">
            {{-- <div class="flex h-full items-center justify-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Welcome From The Dashboard') }}
                </h2>
            </div> --}}
        </x-slot>
        <!-- Left Navigation -->
        <div class="flex">
            <div class="bg-gray-800 text-white w-64 h-screen">
                <!-- Navigation Links -->
                <ul class="mt-0 pt-8">
                    <li class="flex items-center">
                        <x-heroicon-o-adjustments-horizontal class="h-5 w-5 ml-4 mr-4"/>
                        <a href="" class="block px-4 py-2 hover:bg-gray-700">Dashboard</a>
                        <x-heroicon-o-chevron-right class="h-4 w-4 ml-auto mr-2"/>
                    </li>
                    <hr class="border-gray-700 my-4">
                    @active
                    <li class="flex items-center mt-2">
                        <x-heroicon-o-document-chart-bar class="h-5 w-5 ml-4 mr-4"/>
                        <a href="{{ route('student.list') }}" class="block px-4 py-2 hover:bg-gray-700">Students</a>
                        <x-heroicon-o-chevron-right class="h-4 w-4 ml-auto mr-2"/>
                    </li>
                    @endactive
                    @admin
                    <li class="flex items-center mt-2 relative">
                        <x-heroicon-o-user-group class="h-5 w-5 ml-4 mr-4"/>
                        <a href="{{ route('user.list') }}" class="block px-4 py-2 hover:bg-gray-700">User</a>
                        <x-heroicon-o-chevron-down class="h-4 w-4 ml-auto mr-2"/>
                        <!-- Submenu -->
                        <ul class="absolute left-0 hidden mt-2 w-48 bg-gray-800 rounded-lg shadow-lg z-10">
                            <li>
                                <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-700">Create User</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-700">Edit User</a>
                            </li>
                            <li>
                                <a href="{{ route('user.list') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700">List Users</a>
                            </li>
                        </ul>
                    </li>
                    @endadmin
                    @admin
                    <li class="flex items-center mt-2">
                        <x-heroicon-o-cog-8-tooth class="h-5 w-5 ml-4 mr-4"/>
                        <a href="" class="block px-4 py-2 hover:bg-gray-700">API</a>
                        <x-heroicon-o-chevron-down class="h-4 w-4 ml-auto mr-2"/>
                    </li>
                    @endadmin
                    <!-- Add more navigation links as needed -->
                </ul>

                <!-- Footer -->
                <hr class="border-gray-700 my-4">
                <div class="flex items-center">
                    <p class="text-xs text-gray-400 px-4">Developed By Htet Aung Shane</p>
                </div>
                
            </div>

            <!-- Main Content -->
            <div class="flex-1">
                <!-- Content goes here -->
                @yield('content')
            </div>
        </div>
        
</x-app-layout>
