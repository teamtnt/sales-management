<?php

use Illuminate\Support\Facades\Route;
use Teamtnt\SalesManagement\Http\Controllers\ContactsController;
use Teamtnt\SalesManagement\Http\Controllers\DashboardController;
use Teamtnt\SalesManagement\Http\Controllers\TaskListController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');
Route::get('/contacts/import/csv', [ContactsController::class, 'importCSV'])->name('contacts.import.csv');
Route::post('/contacts/import/csv', [ContactsController::class, 'importCSVStore'])->name('contacts.import.csv.store');
Route::get('/contacts/create', [ContactsController::class, 'create'])->name('contacts.create');
Route::post('/contacts/store', [ContactsController::class, 'store'])->name('contacts.store');
Route::get('/contacts/{contact:id}/edit', [ContactsController::class, 'edit'])->name('contacts.edit');
Route::put('/contacts/{contact:id}/update', [ContactsController::class, 'update'])->name('contacts.update');
Route::delete('/contacts/{contact:id}/destroy', [ContactsController::class, 'destroy'])->name('contacts.destroy');

Route::get('/lists', [ListController::class, 'index'])->name('lists.index');
Route::get('/tasks', [TaskListController::class, 'index'])->name('tasklist.index');

Route::get('/pipelines', [ContactsController::class, 'index'])->name('pipelines.index');
