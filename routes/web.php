<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Volt::route('/ong/aguardando-aprovacao', 'ong.aguardando-aprovacao')
    ->middleware(['auth'])
    ->name('ong.aguardando-aprovacao');

require __DIR__.'/auth.php';
