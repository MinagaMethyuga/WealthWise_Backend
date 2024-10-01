<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual Entry</title>
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
        <h1 class="text-white font-semibold py-1 text-md my-auto ml-2">User Dashboard</h1>
    </div>

    <div class="border-2 rounded-xl text-start mt-3 flex items-center cursor-pointer">
        <div class="w-6 h-6 ml-5" style="background-image: url('{{ asset('Assests/credit-card.png') }}');background-size: cover;background-position: center;"></div>
        <h1 class="text-black font-semibold py-1 text-md my-auto ml-2">Card</h1>
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
    <div class="mt-5 ml-6 bg-white flex" style="width: 95%">
        <div class="flex-col">
            <h1 class="text-2xl font-bold">User Banking Dashboard</h1>
            <h2>Welcome back, {{ $userfirst_name }}.</h2>
        </div>
        <div class="ml-auto">
            <livewire:navigation-menu></livewire:navigation-menu>
        </div>
    </div>

    {{--Flex container for cards--}}
    <div class="flex ml-6 mt-3" style="height: 40%; width: 95%;">
        {{--Bank Balance card--}}
        <div style="width: 35%;height: 100%;" class="h-full bg-white rounded-2xl border-2 border-blue-600 shadow-xl">
            <p class="text-black font-semibold text-xl ml-4 mt-3">Account Balance</p>
            <div class="bg-blue-400 mx-auto mt-3 rounded-2xl flex-col text-center" style="height: 75%; width: 93%;">
                <h1 class="mx-auto text-sm font-semibold text-white pt-10">Current balance</h1>
                <h2 class="font-semibold text-white ml-3 text-4xl mt-0">LKR {{ $accountbalance }}</h2>
                <p class="text-white text-md mt-9 ml-3 text-left">{{ $useraccountName }}</p>
            </div>
        </div>
        {{--Bank Income card--}}
        <div style="width: 35%;height: 100%;" class="ml-2 h-full bg-white rounded-2xl border-blue-600 border-2 shadow-xl">
            <p class="text-black font-semibold text-xl ml-4 mt-3">Account Income</p>
            <h2 class="text-xs font-semibold ml-4 mt-1">{{ date('F') }}</h2>
            <h2 class="font-bold text-2xl ml-4 mt-4">LKR {{ $Income }}</h2>
            {{--Chart--}}
            <div style="width: 95%; height: 52%" class="mx-auto flex justify-center items-center">
                <canvas id="incomeChart"></canvas> <!-- Chart for Income -->
            </div>
        </div>
        {{--Bank Expense card--}}
        <div style="width: 35%;height: 100%;" class="ml-2 h-full bg-white rounded-2xl border-blue-600 border-2 shadow-xl">
            <p class="text-black font-semibold text-xl ml-4 mt-3">Account Expends</p>
            <h2 class="text-xs font-semibold ml-4 mt-1">{{ date('F') }}</h2>
            <h2 class="font-bold text-2xl ml-4 mt-4">LKR {{ $expense }}</h2>
            {{--Chart--}}
            <div style="width: 95%; height: 52%" class="mx-auto flex justify-center items-center">
                <canvas id="expenseChart"></canvas> <!-- Chart for Expenses -->
            </div>
        </div>
    </div>

    {{--Flex container for transactions--}}
    <div class="w-3 h-3 mt-2 ml-6 flex " style="width: 95%;height: 42%">
        <div class="bg-white rounded-xl border-blue-600 border-2 shadow-xl" style="width: 63%;height: 100%">
            <h1 class="font-semibold ml-4 mt-2 text-lg">Money Flow</h1>
            {{--Money Flow Chart--}}
            <div class="mx-auto flex justify-center items-center" style="height: 85%;width: 95%;">
                <canvas id="moneyFlowChart"></canvas> <!-- Chart for Money Flow -->
            </div>
        </div>

        {{--Recent Transactions Card--}}
        <div class="bg-white ml-auto rounded-xl flex-col border-blue-600 border-2" style="width: 36%; height: 100%;">
            <h1 class="font-semibold ml-4 mt-2 text-lg">Recent Transactions</h1>
            <div class="mx-4 mt-2" style="height: 80%; overflow-y: auto;">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($recentTransactions as $transaction)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($transaction->type) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">LKR {{ number_format($transaction->amount, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->description }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Script to render charts -->
<script>
    // Fetch Income Data from the server
    fetch('/income-data')
        .then(response => response.json())
        .then(data => {
            const labels = data.map(entry => `Week ${entry.week}`);
            const incomeData = data.map(entry => entry.total);

            const incomeChart = new Chart(document.getElementById('incomeChart'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Income',
                        data: incomeData,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true
                    }]
                }
            });
        });

    // Fetch Expense Data from the server
    fetch('/expense-data')
        .then(response => response.json())
        .then(data => {
            const labels = data.map(entry => `Week ${entry.week}`);
            const expenseData = data.map(entry => entry.total);

            const expenseChart = new Chart(document.getElementById('expenseChart'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Expense',
                        data: expenseData,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: true
                    }]
                }
            });
        });

    // Fetch Money Flow Data (Income vs Expenses) from the server
    fetch('/money-flow-data')
        .then(response => response.json())
        .then(data => {
            const moneyFlowChart = new Chart(document.getElementById('moneyFlowChart'), {
                type: 'bar',
                data: {
                    labels: ['Income', 'Expenses'],
                    datasets: [{
                        label: 'Money Flow',
                        data: [data.income, data.expense],
                        backgroundColor: ['rgba(75, 192, 192, 0.7)', 'rgba(255, 99, 132, 0.7)'],
                        borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                        borderWidth: 1
                    }]
                }
            });
        });
</script>

</body>
</html>
