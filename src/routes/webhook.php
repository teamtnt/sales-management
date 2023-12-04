<?php

use Illuminate\Support\Facades\Route;
use Teamtnt\SalesManagement\Http\Controllers\CampaignController;
use Teamtnt\SalesManagement\Http\Controllers\ContactsController;
use Teamtnt\SalesManagement\Http\Controllers\LeadsController;
use Teamtnt\SalesManagement\Http\Controllers\PostmarkWebhookController;

Route::any('/webhook/postmark', [PostmarkWebhookController::class, 'handle'])->name('webhook.postmark');

Route::any('/webhook/change-stage', [LeadsController::class, 'stageChange'])->name('webhook.stageChange');

Route::any('/webhook/import-contacts', [ContactsController::class, 'importWebhook'])->name('webhook.importContacts');

Route::post('/webhook/add-contact', [ContactsController::class, 'addContact'])->name('webhook.addContact');
