<?php

use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/', fn () => redirect(route('login')));
    Route::get('/login', \App\Livewire\Auth\Login::class)->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', \App\Livewire\Home::class)->name('home');
    Route::get('/profile', \App\Livewire\Auth\Profile::class)->name('profile');
    Route::get('/logout')->name('logout');
});

Route::group(['middleware' => ['role:cashier|superadmin']], function () {
    Route::get('/transactions/create', \App\Livewire\Transaction\Actions::class)->name('transaction.create');
    Route::get('/transactions/index', \App\Livewire\Transaction\Index::class)->name('transaction.index');
    Route::get('/transactions/{transaction}/receipt', \App\Livewire\Transaction\Receipt::class)->name('transaction.receipt');
    Route::get('/customers', \App\Livewire\Customer\Index::class)->name('customers.index');
});

Route::group(['middleware' => ['role:admin|superadmin']], function () {
    Route::get('/menus', \App\Livewire\Menu\Index::class)->name('menus.index');
    Route::get('/categories', \App\Livewire\Category\Index::class)->name('categories.index');
    Route::get('/transactions/export', \App\Livewire\Transaction\Export::class)->name('transaction.export');
    Route::get('/transactions/{transaction}/edit', \App\Livewire\Transaction\Actions::class)->name('transaction.edit');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/restore/menus', \App\Livewire\Restore\Menu\Index::class)->name('restore-menus.index');
});
