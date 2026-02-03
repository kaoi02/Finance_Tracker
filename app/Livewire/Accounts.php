<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Account;

class Accounts extends Component
{
    public $accounts;
    public $name;
    public $type = 'checking';
    public $balance = 0;
    public $currency_code = 'MYR';

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

    public function render()
    {
        $this->accounts = Account::all();
        return view('livewire.accounts')->layout('layouts.app', ['title' => 'Finance Tracker - Accounts']);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'type' => 'required',
            'balance' => 'numeric',
        ]);

        Account::create([
            'user_id' => 1, // Hardcoded for MVP
            'name' => $this->name,
            'type' => $this->type,
            'balance' => $this->balance,
            'currency_code' => $this->currency_code,
        ]);

        $this->reset(['name', 'type', 'balance']);
        $this->dispatch('toast', message: 'Account created successfully!', type: 'success');
    }

    public function delete($id)
    {
        Account::find($id)->delete();
        $this->dispatch('toast', message: 'Account deleted.', type: 'info');
    }
}
