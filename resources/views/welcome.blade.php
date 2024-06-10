<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <h1 class="text-3xl text-center font-bold">Welcome to WealthWise</h1>
        <button class="border-2 text-3xl bg-blue-400 p-2 pl-6 pr-6 rounded-2xl text-white mt-10 ml-12" onclick="loginpage()">Login</button>
        <button class="border-2 text-3xl bg-blue-400 p-2 pl-6 pr-6 rounded-2xl text-white mt-10" onclick="registerpage()">Register</button>
    </x-authentication-card>
    <script>
        function loginpage() {
            window.location.href = "/login";
        }
        function registerpage() {
            window.location.href = "/register";
        }
    </script>
</x-guest-layout>
