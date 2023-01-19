<?php

use Illuminate\Support\Facades\Route;
use Teamtnt\SalesManagement\Http\Controllers\ContactsController;

Route::get('/sales', [ContactsController::class, 'index'])->name('contacts.index');
