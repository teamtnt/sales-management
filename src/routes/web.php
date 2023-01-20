<?php

use Illuminate\Support\Facades\Route;
use Teamtnt\SalesManagement\Http\Controllers\ContactsController;

Route::get('/dashboard', [ContactsController::class, 'index'])->name('dashboard');
Route::get('/sales', [ContactsController::class, 'index'])->name('contacts.index');

Route::get('/pipelines', [ContactsController::class, 'index'])->name('pipelines.index');
