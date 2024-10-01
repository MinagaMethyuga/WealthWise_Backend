<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('WealthWise Admin Dashboard(User Management)') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="border-4 pt-5 rounded-xl">
                @if(isset($users))
                    @foreach($users as $user)
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-4 border border-solid border-gray-500">
                        <div class="max-w-full h-auto p-4 mt-4">
                        <h1 class="font-bold text-xl text-black pl-10">Name: {{ $user->first_name }}</h1>
                        <h2 class="font-medium text-xl text-black pl-10">Email: {{ $user->email }}</h2>
                            <button onclick="deleteUser({{ $user->id }})" class="p-3 border-2 relative -top-14 -right-3/4 rounded-2xl bg-red-900 text-white">Delete User</button>
                        </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <script>
        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                axios.delete('/dashboard', {
                    data: {
                        user_id: userId
                    }
                })
                    .then(function (response) {
                        alert(response.data.message);
                        // Optionally, you can remove the deleted user from the UI
                    })
                    .catch(function (error) {
                        console.error(error);
                        alert('Failed to delete user');
                    });
            }
        }
    </script>
</x-app-layout>
