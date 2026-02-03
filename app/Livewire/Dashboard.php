<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Account;
use App\Models\Transaction;

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

        return view('livewire.dashboard', [
            'totalAssets' => $totalAssets,
            'totalDebt' => $totalDebt,
            'recentTransactions' => $recentTransactions,
        ])->layout('layouts.app', ['title' => 'Finance Tracker - Dashboard']);
    }
}
