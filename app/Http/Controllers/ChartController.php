<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ChartController extends Controller
{
    public function getIncomeData()
    {
        $incomeData = Transaction::where('type', 'income')
            ->selectRaw('SUM(amount) as total, strftime("%W", created_at) as week') // Use strftime to get the week
            ->groupBy('week')
            ->get();

        \Log::info('Income Data:', $incomeData->toArray());

        return response()->json($incomeData);
    }

    public function getExpenseData()
    {
        $expenseData = Transaction::where('type', 'expense')
            ->selectRaw('SUM(amount) as total, strftime("%W", created_at) as week') // Use strftime to get the week
            ->groupBy('week')
            ->get();

        \Log::info('Expense Data:', $expenseData->toArray());

        return response()->json($expenseData);
    }

    public function getMoneyFlowData()
    {
        // Fetch the currently authenticated user
        $user = auth()->user();

        // Fetch total income and expenses for the logged-in user
        $income = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->sum('amount');

        $expense = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->sum('amount');

        return response()->json([
            'income' => $income,
            'expense' => $expense
        ]);
    }


    public function getUserGrowthData()
    {
        // Get the current month
        $currentMonth = Carbon::now()->month;

        // Prepare an array for the labels and data
        $labels = [];
        $data = [];

        // Loop through the last 6 months
        for ($i = 5; $i >= 0; $i--) {
            // Get the month to display
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->format('F'); // Get the month name (e.g., January)

            // Count users registered in that month
            $count = User::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->count();

            $data[] = $count; // Add the count to the data array
        }

        // Return the data as JSON
        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

}
