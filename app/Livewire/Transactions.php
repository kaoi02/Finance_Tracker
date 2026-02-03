<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\Account;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Exception;

class Transactions extends Component
{
    use \Livewire\WithPagination;

    public $search = '';
    public $sortField = 'date';
    public $sortDirection = 'desc';
    public $perPage = 5;
    public $accountFilter = '';

    public $showDeleteModal = false;
    public $idToDelete = null;

    public function confirmDelete()
    {
        if ($this->idToDelete) {
            $this->delete($this->idToDelete);
            $this->idToDelete = null;
            $this->showDeleteModal = false;
        }
    }

    // ... form properties ...
    public $account_id;
    public $category_id;
    public $amount;
    public $description;
    public $date;

    public function mount()
    {
        $this->date = now()->format('Y-m-d');
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function updatedAccountFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Transaction::query()
            ->with(['account', 'category']) // Eager load relationships
            ->select('transactions.*') // Verify we don't need 'accounts.name as account_name' etc if we only sort
            ->join('accounts', 'transactions.account_id', '=', 'accounts.id')
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->where(function ($q) {
                $q->where('transactions.description', 'like', '%' . $this->search . '%')
                    ->orWhere('categories.name', 'like', '%' . $this->search . '%')
                    ->orWhere('accounts.name', 'like', '%' . $this->search . '%');
            })
            ->when($this->accountFilter, function ($query) {
                $query->where('transactions.account_id', $this->accountFilter);
            });

        if ($this->sortField === 'category') {
            $query->orderBy('categories.name', $this->sortDirection);
        } elseif ($this->sortField === 'account') {
            $query->orderBy('accounts.name', $this->sortDirection);
        } else {
            $query->orderBy('transactions.' . $this->sortField, $this->sortDirection);
        }

        $transactions = $query->paginate($this->perPage);

        return view('livewire.transactions', [
            'transactions' => $transactions,
            'accounts' => Account::all(),
            'categories' => Category::all(),
        ])->layout('layouts.app', ['title' => 'Finance Tracker - Transactions']);
    }

    public function store()
    {
        $this->validate([
            'account_id' => 'required|exists:accounts,id',
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric',
            'description' => 'required',
            'date' => 'required|date',
        ]);

        try {
            DB::transaction(function () {
                $category = Category::findOrFail($this->category_id);
                $account = Account::findOrFail($this->account_id);

                // Income adds to balance, Expense subtracts
                $adjustedAmount = $this->amount;
                if ($category->type === 'expense') {
                    $adjustedAmount = -abs($this->amount);
                } else {
                    $adjustedAmount = abs($this->amount);
                }

                // Double-entry lite: Update account balance
                $account->balance += $adjustedAmount;
                $account->save();

                Transaction::create([
                    'account_id' => $this->account_id,
                    'category_id' => $this->category_id,
                    'amount' => $adjustedAmount,
                    'description' => $this->description,
                    'date' => $this->date,
                ]);
            });

            $this->reset(['account_id', 'category_id', 'amount', 'description', 'date']);
            $this->date = now()->format('Y-m-d');
            $this->dispatch('toast', message: 'Transaction recorded!', type: 'success');
        } catch (Exception $e) {
            $this->dispatch('toast', message: 'Failed to record transaction. Please try again.', type: 'error');
        }
    }

    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $transaction = Transaction::findOrFail($id);
                $account = $transaction->account;

                // Reverse balance update
                $account->balance -= $transaction->amount;
                $account->save();

                $transaction->delete();
            });

            $this->dispatch('toast', message: 'Transaction deleted.', type: 'info');
        } catch (Exception $e) {
            $this->dispatch('toast', message: 'Failed to delete transaction.', type: 'error');
        }
    }
}
