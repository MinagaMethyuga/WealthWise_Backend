<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

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
        // Fetch total income and expenses for money flow chart
        $income = Transaction::where('type', 'income')->sum('amount');
        $expense = Transaction::where('type', 'expense')->sum('amount');

        return response()->json([
            'income' => $income,
            'expense' => $expense
        ]);
    }
}
