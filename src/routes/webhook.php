<?php

use Illuminate\Support\Facades\Route;
use Teamtnt\SalesManagement\Http\Controllers\PostmarkWebhookController;

Route::any('/webhook/postmark', [PostmarkWebhookController::class, 'handle'])->name('webhook.postmark');
