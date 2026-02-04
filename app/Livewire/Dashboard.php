<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\Setting;

class Dashboard extends Component
{
    public function render()
    {
        $accounts = Account::where('user_id', 1)->get(); // Hardcoded user for MVP
        $totalAssets = $accounts->where('balance', '>', 0)->sum('balance');
        $totalDebt = $accounts->where('balance', '<', 0)->sum('balance');

        $recentTransactions = Transaction::with(['account', 'category'])
            ->latest('date')
            ->take(5)
            ->get();

        $monthStart = now()->startOfMonth();

        // Monthly Totals
        $monthlyIncome = Transaction::query()
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where('categories.type', 'income')
            ->where('transactions.date', '>=', $monthStart)
            ->sum('transactions.amount');

        $monthlyExpenses = abs(Transaction::query()
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where('categories.type', 'expense')
            ->where('transactions.date', '>=', $monthStart)
            ->sum('transactions.amount'));

        $spendingByCategory = Transaction::query()
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where('categories.type', 'expense')
            ->selectRaw('categories.name, ABS(SUM(transactions.amount)) as total')
            ->groupBy('categories.name')
            ->get();

        return view('livewire.dashboard', [
            'totalAssets' => $totalAssets,
            'totalDebt' => $totalDebt,
            'recentTransactions' => $recentTransactions,
            'spendingByCategory' => $spendingByCategory,
            'monthlyIncome' => $monthlyIncome,
            'monthlyExpenses' => $monthlyExpenses,
            'currency' => Setting::get('currency', 'RM'),
        ])->layout('layouts.app', ['title' => 'Finance Tracker - Dashboard']);
    }
}
