<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('WealthWise Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h1 class="text-2xl font-bold">Welcome to WealthWise {{ $userfirst_name }}</h1>
                <div class="border-4 w-1/3 pt-0 rounded-xl mt-6">
                    <h1 class="pl-4 mt-5">User Name: {{ $userfirst_name }} {{ $userlast_name }}</h1>
                    <h2 class="pl-4 mt-3 mb-3">User Email: {{ $userEmail }}</h2>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
