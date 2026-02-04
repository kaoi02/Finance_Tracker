<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Account;
use App\Models\Setting;
use Exception;

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
        return view('livewire.accounts', [
            'currency' => Setting::get('currency', 'RM'),
        ])->layout('layouts.app', ['title' => 'Finance Tracker - Accounts']);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'type' => 'required',
            'balance' => 'numeric',
        ]);

        try {
            Account::create([
                'user_id' => 1, // Hardcoded for MVP
                'name' => $this->name,
                'type' => $this->type,
                'balance' => $this->balance,
                'currency_code' => $this->currency_code,
            ]);

            $this->reset(['name', 'type', 'balance']);
            $this->dispatch('toast', message: 'Account created successfully!', type: 'success');
        } catch (Exception $e) {
            $this->dispatch('toast', message: 'Failed to create account.', type: 'error');
        }
    }

    public function delete($id)
    {
        try {
            Account::findOrFail($id)->delete();
            $this->dispatch('toast', message: 'Account deleted.', type: 'info');
        } catch (Exception $e) {
            $this->dispatch('toast', message: 'Failed to delete account.', type: 'error');
        }
    }
}
