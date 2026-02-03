<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Accounts;
use App\Livewire\Categories;
use App\Livewire\Transactions;
use App\Livewire\Dashboard;

Route::get('/', App\Livewire\Dashboard::class)->name('dashboard');
Route::get('/accounts', Accounts::class)->name('accounts');
Route::get('/categories', Categories::class)->name('categories');
Route::get('/transactions', Transactions::class)->name('transactions');
