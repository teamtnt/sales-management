<?php

use Illuminate\Support\Facades\Route;
use Teamtnt\SalesManagement\Http\Controllers\CompanyController;
use Teamtnt\SalesManagement\Http\Controllers\ContactsController;
use Teamtnt\SalesManagement\Http\Controllers\DashboardController;
use Teamtnt\SalesManagement\Http\Controllers\DealController;
use Teamtnt\SalesManagement\Http\Controllers\MessagesController;
use Teamtnt\SalesManagement\Http\Controllers\PipelineController;
use Teamtnt\SalesManagement\Http\Controllers\TagsController;
use Teamtnt\SalesManagement\Http\Controllers\TaskListController;
use Teamtnt\SalesManagement\Http\Controllers\WorkflowController;
use Teamtnt\SalesManagement\Http\Controllers\ContactListController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Contacts
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');
Route::get('/contacts/import/csv', [ContactsController::class, 'importCSV'])->name('contacts.import.csv');
Route::post('/contacts/import/csv', [ContactsController::class, 'importCSVStore'])->name('contacts.import.csv.store');
Route::get('/contacts/create', [ContactsController::class, 'create'])->name('contacts.create');
Route::post('/contacts/store', [ContactsController::class, 'store'])->name('contacts.store');
Route::get('/contacts/{contact:id}/edit', [ContactsController::class, 'edit'])->name('contacts.edit');
Route::put('/contacts/{contact:id}/update', [ContactsController::class, 'update'])->name('contacts.update');
Route::delete('/contacts/{contact:id}/destroy', [ContactsController::class, 'destroy'])->name('contacts.destroy');

// Companies
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
Route::post('/companies/store', [CompanyController::class, 'store'])->name('companies.store');
Route::get('/companies/{company:id}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
Route::put('/companies/{company:id}/update', [CompanyController::class, 'update'])->name('companies.update');
Route::delete('/companies/{company:id}/destroy', [CompanyController::class, 'destroy'])->name('companies.destroy');

// Contact lists
Route::get('/lists', [ContactListController::class, 'index'])->name('lists.index');
Route::get('/lists/{contactList:id}/edit', [ContactListController::class, 'edit'])->name('lists.edit');
Route::delete('/lists/{contactList:id}/destroy', [ContactListController::class, 'destroy'])->name('lists.destroy');
Route::delete('/lists/contact/{contactListContact:id}/destroy', [ContactListController::class, 'contactDestroy'])->name('lists.contact.destroy');
Route::get('/lists/contact/{task}/{pipelelineStage}/create', [ContactListController::class, 'createListFromPipelineStage'])->name('lists.create.from.stage');
Route::post('/lists/contact/from/stage', [ContactListController::class, 'createListFromPipelineStageStore'])->name('lists.create.from.stage.store');

// Deals
Route::get('/deals', [DealController::class, 'index'])->name('deals.index');
Route::get('/deals/create', [DealController::class, 'create'])->name('deals.create');
Route::post('/deals/store', [DealController::class, 'store'])->name('deals.store');
Route::get('/deals/{deal:id}/edit', [DealController::class, 'edit'])->name('deals.edit');
Route::put('/deals/{deal:id}/update', [DealController::class, 'update'])->name('deals.update');
Route::delete('/deals/{deal:id}/destroy', [DealController::class, 'destroy'])->name('deals.destroy');

Route::post('/stage/chage', [TaskListController::class, 'stageChange'])->name('stage.change');

// Tags
Route::get('/tags', [TagsController::class, 'index'])->name('tags.index');
Route::get('/tags/create', [TagsController::class, 'create'])->name('tags.create');
Route::post('/tags/store', [TagsController::class, 'store'])->name('tags.store');
Route::get('/tags/{tag:id}/edit', [TagsController::class, 'edit'])->name('tags.edit');
Route::put('/tags/{tag:id}/update', [TagsController::class, 'update'])->name('tags.update');
Route::delete('/tags/{tag:id}/destroy', [TagsController::class, 'destroy'])->name('tags.destroy');


// Pipelines
Route::get('/pipelines', [PipelineController::class, 'index'])->name('pipelines.index');
Route::get('/pipelines/create', [PipelineController::class, 'create'])->name('pipelines.create');
Route::post('/pipelines/store', [PipelineController::class, 'store'])->name('pipelines.store');
Route::get('/pipelines/{pipeline:id}/edit', [PipelineController::class, 'edit'])->name('pipelines.edit');
Route::put('/pipelines/{pipeline:id}/update', [PipelineController::class, 'update'])->name('pipelines.update');
Route::delete('/pipelines/{pipeline:id}/destroy', [PipelineController::class, 'destroy'])->name('pipelines.destroy');

Route::get('/tasks', [TaskListController::class, 'index'])->name('tasklist.index');
Route::get('/task/create', [TaskListController::class, 'create'])->name('tasklist.create');
Route::post('/task/store', [TaskListController::class, 'store'])->name('tasklist.store');
Route::get('/task/{task}', [TaskListController::class, 'show'])->name('tasklist.show');
Route::get('/task/{task}/edit', [TaskListController::class, 'edit'])->name('tasklist.edit');
Route::put('/task/{task}/update', [TaskListController::class, 'update'])->name('tasklist.update');
Route::delete('/task/{task:id}/destroy', [TaskListController::class, 'destroy'])->name('tasklist.destroy');

Route::group(['prefix' => 'task/{task}'], function () {
    // Messages
    Route::get('/messages', [MessagesController::class, 'index'])->name('messages.index');
    Route::get('/messages/create', [MessagesController::class, 'create'])->name('messages.create');
    Route::post('/messages/store', [MessagesController::class, 'store'])->name('messages.store');
    Route::get('/messages/{message:id}/edit', [MessagesController::class, 'edit'])->name('messages.edit');
    Route::put('/messages/{message:id}/update', [MessagesController::class, 'update'])->name('messages.update');
    Route::delete('/messages/{message:id}/destroy', [MessagesController::class, 'destroy'])->name('messages.destroy');
    Route::post('/messages/{message:id}/send', [MessagesController::class, 'sendToAllLeads'])->name('messages.send');

    // Workflows
    Route::get('/workflows', [WorkflowController::class, 'index'])->name('workflows.index');
    Route::get('/workflows/create', [WorkflowController::class, 'create'])->name('workflows.create');
    Route::post('/workflows/store', [WorkflowController::class, 'store'])->name('workflows.store');
    Route::get('/workflows/{workflow:id}/debug', [WorkflowController::class, 'debug'])->name('workflows.debug');
    Route::get('/workflows/{workflow:id}/edit', [WorkflowController::class, 'edit'])->name('workflows.edit');
    Route::post('/workflows/{workflow:id}/update', [WorkflowController::class, 'update'])->name('workflows.update');
    Route::delete('/workflows/{workflow:id}/destroy', [WorkflowController::class, 'destroy'])->name('workflows.destroy');
    Route::post('/workflows/{workflow:id}/publish', [WorkflowController::class, 'publish'])->name('workflows.publish');
    Route::post('/workflows/{workflow:id}/unpublish', [WorkflowController::class, 'unpublish'])->name('workflows.unpublish');
});
