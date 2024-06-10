<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('WealthWise Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="border-4 w-1/3 pt-5 rounded-xl">
                    <h1 class="font-bold text-3xl pl-7">User Count</h1>
                    <h2 class="pl-7 text-xl pt-2">There are: {{ $userCount }} Users</h2>
                    <div class="flex justify-center mt-5">
                        <button class="border-4 border-gray-600 p-2 rounded-xl mt-7 mb-7" onclick="UserShow()">Manage all Users</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function UserShow(){
            window.location.href = '{{ route("user_list_dashboard") }}';
        }
    </script>
</x-app-layout>

