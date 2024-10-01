<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@latest/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="w-full h-screen bg-white overflow-hidden flex">
{{--navigation panel--}}
<div class="h-screen flex-col justify-center text-center border-r-2 border-blue-600 shadow-xl" style="width: 20%">
    <h1 class="text-black font-bold mt-6 text-3xl mx-auto">WealthWise</h1>

    <div class="border-2 rounded-xl text-start mt-10 flex items-center cursor-pointer bg-blue-600">
        <div class="w-6 h-6 ml-5" style="background-image: url('{{ asset('Assests/home.png') }}');background-size: cover;background-position: center;"></div>
        <h1 class="text-white font-semibold py-1 text-md my-auto ml-2">Admin Dashboard</h1>
    </div>

    <div class="border-2 rounded-xl text-start mt-3 flex items-center cursor-pointer">
        <div class="w-6 h-6 ml-5" style="background-image: url('{{ asset('Assests/user.png') }}');background-size: cover;background-position: center;"></div>
        <h1 class="text-black font-semibold py-1 text-md my-auto ml-2">User Management</h1>
    </div>

    <div class="border-2 rounded-xl text-start mt-3 flex items-center cursor-pointer">
        <div class="w-6 h-6 ml-5" style="background-image: url('{{ asset('Assests/transaction.png') }}');background-size: cover;background-position: center;"></div>
        <h1 class="text-black font-semibold py-1 text-md my-auto ml-2">Transactions</h1>
    </div>

    <div class="border-2 rounded-xl text-start mt-3 flex items-center cursor-pointer">
        <div class="w-6 h-6 ml-5" style="background-image: url('{{ asset('Assests/user.png') }}');background-size: cover;background-position: center;"></div>
        <h1 class="text-black font-semibold py-1 text-md my-auto ml-2">Accounts</h1>
    </div>

    <div class="mx-auto mt-56 text-left flex" style="width: 90%; height: 12%;">
        <div class="rounded-full bg-black w-12 h-12 mt-3 ml-3" style="background-image: url('{{ asset('Assests/tap-to-pay.png') }}');background-size: cover;"></div>
        <div class="flex-col ml-3 mt-3">
            <h1 class="text-lg font-semibold">{{ $userfirst_name }} {{ $userlast_name }}</h1>
            <h2 class="text-xs font-semibold">{{ $userEmail }}</h2>
        </div>
    </div>
</div>
{{--right panel--}}
<div class="w-4/5 h-screen relative">
    {{--Main Text Area--}}
    <div class="mt-5 ml-6 bg-white flex " style="width: 95%">
        <div class="flex-col">
            <h1 class="text-2xl font-bold">Welcome to Admin Dashboard</h1>
            <h2>Welcome back, {{ $userfirst_name }}.</h2>
        </div>
        <div class="ml-auto">
            <livewire:navigation-menu></livewire:navigation-menu>
        </div>
    </div>

    {{--Main Content Area--}}
    <div class="flex ml-6 mt-3" style="height: 40%; width: 95%;">
        <div class="bg-white rounded-2xl border-2 border-red-600 flex-col text-center" style="width: 41%; height: 100%;">
            <h1 class="text-2xl font-bold mt-4">WealthWise User Management</h1>
            <h1 class="text-left font-normal text-sm ml-6 mt-7">Manage Users</h1>
            <p class="text-left font-semibold text-lg ml-6">Total Wealthy Users: {{ $userCount }}</p>
            <button class="border rounded-2xl p-3 hover:border-blue-600 transition-all mt-12 border-red-600">Manage Users</button>
        </div>

        {{--User Growth Chart--}}
        <div class="bg-white ml-auto rounded-2xl border-2 border-green-600 flex-col" style="height: 100%; width: 58%;">
            <h1 class="font-semibold text-xl ml-6 mt-3">User Growth Chart</h1>
            <canvas id="userGrowthChart" class="mx-auto mt-3" style="width: 90%; height: 76%;"></canvas>
        </div>
    </div>

    {{--Flex container for cards--}}
    <div class="mt-3 ml-6 flex" style="width: 95%;height: 40%;">
        {{--User Activity Table--}}
        <div class="bg-red-50 rounded-2xl border-2 border-blue-600" style="height: 100%; width: 60%;">
            <h1 class="font-semibold text-xl ml-6 mt-3">User Activity</h1>
            <div class="overflow-auto h-3/4 mx-6 mt-3">
                <table class="min-w-full bg-white border border-gray-300 text-center rounded-2xl">
                    <thead>
                    <tr class="text-black">
                        <th class="py-2 border-b">Action</th>
                        <th class="py-2 border-b">Username</th>
                        <th class="py-2 border-b">Timestamp</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 border-b">Registered</td>
                        <td class="py-2 border-b">user1</td>
                        <td class="py-2 border-b">2024-10-01 10:00 AM</td>
                    </tr>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 border-b">Removed</td>
                        <td class="py-2 border-b">user2</td>
                        <td class="py-2 border-b">2024-09-30 09:30 AM</td>
                    </tr>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 border-b">Registered</td>
                        <td class="py-2 border-b">user3</td>
                        <td class="py-2 border-b">2024-09-29 11:15 AM</td>
                    </tr>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 border-b">Removed</td>
                        <td class="py-2 border-b">user4</td>
                        <td class="py-2 border-b">2024-09-28 08:45 AM</td>
                    </tr>
                    <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>

        {{--Notification center--}}
        <div class="bg-white ml-auto rounded-2xl border-2 border-pink-600 flex-col text-center" style="height: 100%; width: 39%;">
            <h1 class="text-2xl font-bold mt-8">Admin Notifications Center</h1>
            <p class="text-sm text-black opacity-50">Send Notification to the WealthWise Mobile application</p>
            <button class="border rounded-2xl p-3 border-blue-600 hover:border-red-600 transition-all mt-12">Send Notification</button>
        </div>
    </div>
</div>

<script>
    const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
    const userGrowthChart = new Chart(userGrowthCtx, {
        type: 'line',
        data: {
            labels: [], // This will be populated dynamically
            datasets: [{
                label: 'User Growth',
                data: [], // This will also be populated dynamically
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    function fetchUserGrowthData() {
        fetch('/api/user-growth') // Adjust the URL as necessary
            .then(response => response.json())
            .then(data => {
                // Update the chart with new data
                userGrowthChart.data.labels = data.labels;
                userGrowthChart.data.datasets[0].data = data.data;
                userGrowthChart.update(); // Refresh the chart
            })
            .catch(error => console.error('Error fetching user growth data:', error));
    }

    // Fetch data every 10 seconds (adjust as needed)
    setInterval(fetchUserGrowthData, 10000);

    // Initial fetch to populate the chart
    fetchUserGrowthData();
</script>
</body>
</html>
