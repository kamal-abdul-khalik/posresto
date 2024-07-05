<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', \App\Livewire\Home::class)->name('home');
    Route::get('/profile', \App\Livewire\Auth\Profile::class)->name('profile');
    Route::get('/logout')->name('logout');

    Route::get('/menus', \App\Livewire\Menu\Index::class)->name('menus.index');
    Route::get('/customers', \App\Livewire\Customer\Index::class)->name('customers.index');

    Route::get('/transactions/create', \App\Livewire\Transaction\Actions::class)->name('transaction.create');
    Route::get('/transactions/index', \App\Livewire\Transaction\Index::class)->name('transaction.index');
    Route::get('/transactions/{transaction}/edit', \App\Livewire\Transaction\Actions::class)->name('transaction.edit');
    Route::get('/transactions/{transaction}/receipt', \App\Livewire\Transaction\Receipt::class)->name('transaction.receipt');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', \App\Livewire\Auth\Login::class)->name('login');
});
