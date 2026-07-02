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

Volt::route('/ong/recusada', 'ong.recusada')
    ->middleware(['auth'])
    ->name('ong.recusada');

Volt::route('/admin/ongs/pendentes', 'admin.aprovacao-ongs')
    ->middleware(['auth', 'admin.only'])
    ->name('admin.ongs.pendentes');

require __DIR__.'/auth.php';
