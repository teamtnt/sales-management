<?php

use Illuminate\Support\Facades\Route;
use Teamtnt\SalesManagement\Http\Controllers\CompanyController;
use Teamtnt\SalesManagement\Http\Controllers\ContactsController;
use Teamtnt\SalesManagement\Http\Controllers\DashboardController;
use Teamtnt\SalesManagement\Http\Controllers\DealController;
use Teamtnt\SalesManagement\Http\Controllers\LeadActivitiesController;
use Teamtnt\SalesManagement\Http\Controllers\LeadNotesController;
use Teamtnt\SalesManagement\Http\Controllers\LeadsController;
use Teamtnt\SalesManagement\Http\Controllers\MessagesController;
use Teamtnt\SalesManagement\Http\Controllers\PipelineController;
use Teamtnt\SalesManagement\Http\Controllers\TagsController;
use Teamtnt\SalesManagement\Http\Controllers\CampaignController;
use Teamtnt\SalesManagement\Http\Controllers\WorkflowController;
use Teamtnt\SalesManagement\Http\Controllers\ContactListController;
use Teamtnt\SalesManagement\Http\Controllers\DocsController;


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->can(config('sales-management.permission_prefix').'.view-dashboard');

// Contacts
Route::group(['middleware' => ['can:'.config('sales-management.permission_prefix').'.view-contacts'  ]], function () {
    Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/import/csv', [ContactsController::class, 'importCSV'])->name('contacts.import.csv');
    Route::post('/contacts/import/csv', [ContactsController::class, 'importCSVStore'])->name('contacts.import.csv.store');
    Route::get('/contacts/create', [ContactsController::class, 'create'])->name('contacts.create');
    Route::post('/contacts/store', [ContactsController::class, 'store'])->name('contacts.store');
    Route::get('/contacts/{contact:id}/edit', [ContactsController::class, 'edit'])->name('contacts.edit');
    Route::put('/contacts/{contact:id}/update', [ContactsController::class, 'update'])->name('contacts.update');
    Route::post('/contacts/{contact:id}/sync-tags', [ContactsController::class, 'syncTags'])->name('contacts.sync-tags');
    Route::delete('/contacts/{contact:id}/destroy', [ContactsController::class, 'destroy'])->name('contacts.destroy');
});

// Companies
Route::group(['middleware' => ['can:'.config('sales-management.permission_prefix').'.view-companies'  ]], function () {
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies/store', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/companies/{company:id}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/companies/{company:id}/update', [CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/companies/{company:id}/destroy', [CompanyController::class, 'destroy'])->name('companies.destroy');
});

// Contact lists
Route::group(['middleware' => ['can:'.config('sales-management.permission_prefix').'.view-lists'  ]], function () {

Route::get('/lists', [ContactListController::class, 'index'])->name('lists.index');
Route::get('/lists/{contactList:id}/edit', [ContactListController::class, 'edit'])->name('lists.edit');
Route::delete('/lists/{contactList:id}/destroy', [ContactListController::class, 'destroy'])->name('lists.destroy');
Route::delete('/lists/contact/{contactListContact:id}/destroy', [ContactListController::class, 'contactDestroy'])->name('lists.contact.destroy');
Route::post('/lists/{contactList:id}/contact/add', [ContactListController::class, 'contactAdd'])->name('lists.contact.add');
Route::get('/lists/{contactList:id}/add', [ContactListController::class, 'showContactAdd'])->name('lists.contact.showAdd');
Route::get('/lists/contact/{campaign}/{pipelelineStage}/create', [ContactListController::class, 'createListFromPipelineStage'])->name('lists.create.from.stage');
Route::post('/lists/contact/from/stage', [ContactListController::class, 'createListFromPipelineStageStore'])->name('lists.create.from.stage.store');
Route::get('/lists/create', [ContactListController::class, 'create'])->name('lists.create');
Route::post('/lists/store', [ContactListController::class, 'store'])->name('lists.store');
});

// Deals
Route::group(['middleware' => ['can:'.config('sales-management.permission_prefix').'.view-deals'  ]], function () {
Route::get('/deals', [DealController::class, 'index'])->name('deals.index');
Route::get('/deals/create', [DealController::class, 'create'])->name('deals.create');
Route::post('/deals/store', [DealController::class, 'store'])->name('deals.store');
Route::get('/deals/{deal:id}/edit', [DealController::class, 'edit'])->name('deals.edit');
Route::put('/deals/{deal:id}/update', [DealController::class, 'update'])->name('deals.update');
Route::delete('/deals/{deal:id}/destroy', [DealController::class, 'destroy'])->name('deals.destroy');
});



// Tags
Route::group(['middleware' => ['can:'.config('sales-management.permission_prefix').'.view-tags'  ]], function () {
Route::get('/tags', [TagsController::class, 'index'])->name('tags.index');
Route::get('/tags/create', [TagsController::class, 'create'])->name('tags.create');
Route::post('/tags/store', [TagsController::class, 'store'])->name('tags.store');
Route::get('/tags/{tag:id}/edit', [TagsController::class, 'edit'])->name('tags.edit');
Route::put('/tags/{tag:id}/update', [TagsController::class, 'update'])->name('tags.update');
Route::delete('/tags/{tag:id}/destroy', [TagsController::class, 'destroy'])->name('tags.destroy');
});

// Lead Activities
Route::group(['middleware' => ['can:'.config('sales-management.permission_prefix').'.view-activities'  ]], function () {
Route::get('/lead-activities', [LeadActivitiesController::class, 'index'])->name('lead-activities.index');
Route::post('/lead-activities/{lead:id}/note/store', [LeadActivitiesController::class, 'store'])->name('store-lead-activity');
Route::delete('/lead-activities/{lead:id}/note/{note:id}/destroy', [LeadActivitiesController::class, 'destroy'])->name('destroy-lead-activity');
Route::get('/lead-activities/{leadActivity:id}/toggle-status', [LeadActivitiesController::class, 'toggleStatus'])->name('lead-activities.toggle-status');
});

// Lead Notes
Route::post('/lead-notes/{lead:id}/activity/store', [LeadNotesController::class, 'storeLeadNote'])->name('store-lead-note');
Route::delete('/lead-notes/{lead:id}/activity/{activity:id}/destroy', [LeadNotesController::class, 'destroyLeadNote'])->name('destroy-lead-note');

Route::post('/lead-tags/{contact:id}/sync-tags', [LeadsController::class, 'syncTags'])->name('leads.sync-tags');

// Pipelines
Route::group(['middleware' => ['can:'.config('sales-management.permission_prefix').'.view-pipelines'  ]], function () {
Route::get('/pipelines', [PipelineController::class, 'index'])->name('pipelines.index');
Route::get('/pipelines/create', [PipelineController::class, 'create'])->name('pipelines.create');
Route::post('/pipelines/store', [PipelineController::class, 'store'])->name('pipelines.store');
Route::get('/pipelines/{pipeline:id}/edit', [PipelineController::class, 'edit'])->name('pipelines.edit');
Route::put('/pipelines/{pipeline:id}/update', [PipelineController::class, 'update'])->name('pipelines.update');
Route::delete('/pipelines/{pipeline:id}/destroy', [PipelineController::class, 'destroy'])->name('pipelines.destroy');
});

Route::group(['middleware' => ['can:'.config('sales-management.permission_prefix').'.view-campaigns'  ]], function () {
    Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaign.index');
    Route::get('/campaign/create', [CampaignController::class, 'create'])->name('campaign.create');
    Route::post('/campaign/store', [CampaignController::class, 'store'])->name('campaign.store');
    Route::get('/campaign/{campaign}', [CampaignController::class, 'show'])->name('campaign.show');
    Route::get('/campaign/{campaign}/edit', [CampaignController::class, 'edit'])->name('campaign.edit');
    Route::put('/campaign/{campaign}/update', [CampaignController::class, 'update'])->name('campaign.update');
    Route::delete('/campaign/{campaign:id}/destroy', [CampaignController::class, 'destroy'])->name('campaign.destroy');
    Route::post('/stage/chage', [CampaignController::class, 'stageChange'])->name('stage.change');
});

Route::group(['prefix' => 'campaign/{campaign}'], function () {
    // Messages
    Route::group(['middleware' => ['can:'.config('sales-management.permission_prefix').'.view-messages'  ]], function () {
        Route::get('/messages', [MessagesController::class, 'index'])->name('messages.index');
        Route::get('/messages/create', [MessagesController::class, 'create'])->name('messages.create');
        Route::post('/messages/store', [MessagesController::class, 'store'])->name('messages.store');
        Route::get('/messages/{message:id}/edit', [MessagesController::class, 'edit'])->name('messages.edit');
        Route::put('/messages/{message:id}/update', [MessagesController::class, 'update'])->name('messages.update');
        Route::delete('/messages/{message:id}/destroy', [MessagesController::class, 'destroy'])->name('messages.destroy');
        Route::post('/messages/{message:id}/send', [MessagesController::class, 'sendToAllLeads'])->name('messages.send');
        Route::post('/message/{lead:id}/send', [MessagesController::class, 'sendMessageToLead'])->name('send.message');
    });

    // Workflows
    Route::group(['middleware' => ['can:'.config('sales-management.permission_prefix').'.view-workflows'  ]], function () {
        Route::get('/workflows', [WorkflowController::class, 'index'])->name('workflows.index');
        Route::get('/workflows/create', [WorkflowController::class, 'create'])->name('workflows.create');
        Route::post('/workflows/store', [WorkflowController::class, 'store'])->name('workflows.store');
        Route::get('/workflows/{workflow:id}', [WorkflowController::class, 'show'])->name('workflows.show');
        Route::get('/workflows/{workflow:id}/debug', [WorkflowController::class, 'debug'])->name('workflows.debug');
        Route::get('/workflows/{workflow:id}/edit', [WorkflowController::class, 'edit'])->name('workflows.edit');
        Route::post('/workflows/{workflow:id}/update', [WorkflowController::class, 'update'])->name('workflows.update');
        Route::delete('/workflows/{workflow:id}/destroy', [WorkflowController::class, 'destroy'])->name('workflows.destroy');
        Route::post('/workflows/{workflow:id}/publish', [WorkflowController::class, 'publish'])->name('workflows.publish');
        Route::post('/workflows/{workflow:id}/unpublish', [WorkflowController::class, 'unpublish'])->name('workflows.unpublish');
        Route::post('/workflows/{workflow:id}/run', [WorkflowController::class, 'run'])->name('workflows.run');
    });
});

Route::group(['middleware' => ['can:'.config('sales-management.permission_prefix').'.view-docs'  ]], function () {
    Route::get('/docs/markdown', [DocsController::class, 'markdown'])->name('docs.markdown');
    Route::get('/docs/pipelines', [DocsController::class, 'pipelines'])->name('docs.pipelines');
    Route::get('/docs/workflow', [DocsController::class, 'workflow'])->name('docs.workflow');
});
