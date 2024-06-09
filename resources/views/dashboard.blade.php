<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @foreach($users as $user)
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-4">
                        <div class="max-w-full max-h-full p-4">
                            <h1 class="font-bold text-xl text-black pl-10">Name: {{ $user->Fname }}</h1>
                            <h2 class="font-medium text-xl text-black pl-10">Email: {{ $user->email }}</h2>

                            {{-- buttons with the delete user funtionality --}}
                            <button onclick="deleteUser({{ $user->id }})" class="bg-neutral-300 relative left-3/4 -top-7 p-2 rounded-xl">Delete User</button>
                        </div>
                    </div>
                @endforeach
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
