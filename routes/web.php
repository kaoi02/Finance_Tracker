<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Accounts;
use App\Livewire\Categories;
use App\Livewire\Transactions;
use App\Livewire\Dashboard;
use App\Livewire\About;
use App\Livewire\Guide;

Route::get('/', Dashboard::class)->name('dashboard');
Route::get('/accounts', Accounts::class)->name('accounts');
Route::get('/categories', Categories::class)->name('categories');
Route::get('/transactions', Transactions::class)->name('transactions');
Route::get('/about', About::class)->name('about');
Route::get('/guide', Guide::class)->name('guide');
