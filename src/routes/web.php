<?php

use Illuminate\Support\Facades\Route;
use Teamtnt\SalesManagement\Http\Controllers\ContactsController;
use Teamtnt\SalesManagement\Http\Controllers\DashboardController;
use Teamtnt\SalesManagement\Http\Controllers\TaskListController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');
Route::get('/lists', [ListController::class, 'index'])->name('lists.index');
Route::get('/tasks', [TaskListController::class, 'index'])->name('tasklist.index');

Route::get('/pipelines', [ContactsController::class, 'index'])->name('pipelines.index');
