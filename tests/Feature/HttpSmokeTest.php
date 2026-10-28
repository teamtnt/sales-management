<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Teamtnt\SalesManagement\Models\Campaign;
use Teamtnt\SalesManagement\Models\Contact;
use Teamtnt\SalesManagement\Models\ContactList;
use Teamtnt\SalesManagement\Models\Pipeline;

/*
 * Renders the main pages (yajra DataTables, laravelcollective Form views) and their
 * DataTables AJAX endpoints against MySQL, which the fulltext migration requires.
 *
 * Skipped unless SM_TEST_DB_DATABASE names a scratch MySQL database. It only ever runs the
 * additive `migrate` command and wraps every test in a transaction that is rolled back.
 */
beforeEach(function () {
    if (! env('SM_TEST_DB_DATABASE')) {
        $this->markTestSkipped('Set SM_TEST_DB_DATABASE to a scratch MySQL database to run the HTTP smoke tests.');
    }

    config()->set('database.connections.sales_management_mysql', [
        'driver' => 'mysql',
        'host' => env('SM_TEST_DB_HOST', '127.0.0.1'),
        'port' => env('SM_TEST_DB_PORT', '3306'),
        'database' => env('SM_TEST_DB_DATABASE'),
        'username' => env('SM_TEST_DB_USERNAME', 'root'),
        'password' => env('SM_TEST_DB_PASSWORD', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
    ]);
    config()->set('database.default', 'sales_management_mysql');
    config()->set('app.key', 'base64:'.base64_encode(str_repeat('k', 32)));
    config()->set('sales-management.userModel', User::class);

    if (! Schema::hasTable('users')) {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    $this->artisan('migrate', ['--force' => true])->assertExitCode(0);

    DB::beginTransaction();

    $this->user = (new User)->forceFill([
        'name' => 'Smoke Test',
        'email' => 'smoke-'.uniqid().'@example.com',
        'password' => 'not-a-real-hash',
    ]);
    $this->user->save();

    $this->withoutVite();
    $this->actingAs($this->user);
});

afterEach(function () {
    if (DB::transactionLevel() > 0) {
        DB::rollBack();
    }
});

dataset('index routes', ['contacts.index', 'lists.index', 'tags.index', 'pipelines.index', 'campaign.index', 'lead-activities.index']);

it('renders the DataTables index pages', function (string $route) {
    $this->get(route('teamtnt.sales-management.'.$route))->assertOk();
})->with('index routes');

it('returns DataTables JSON for the index pages', function (string $route) {
    Contact::factory()->create();

    $this->getJson(route('teamtnt.sales-management.'.$route, ['draw' => 1, 'start' => 0, 'length' => 10]), ['X-Requested-With' => 'XMLHttpRequest'])
        ->assertOk()
        ->assertJsonStructure(['draw', 'recordsTotal', 'recordsFiltered', 'data']);
})->with('index routes');

it('renders the Form:: based create pages', function (string $route) {
    $this->get(route('teamtnt.sales-management.'.$route))->assertOk()->assertSee('<form', false);
})->with(['contacts.create', 'lists.create', 'tags.create', 'pipelines.create', 'campaign.create']);

it('renders the Form:: based edit pages', function () {
    $contact = Contact::factory()->create();
    $contactList = ContactList::create(['name' => 'Smoke list']);
    $pipeline = Pipeline::query()->firstOrFail();
    $campaign = Campaign::create(['name' => 'Smoke campaign', 'pipeline_id' => $pipeline->id, 'contact_list_id' => $contactList->id]);

    $this->get(route('teamtnt.sales-management.contacts.edit', $contact))->assertOk()->assertSee($contact->email);
    $this->get(route('teamtnt.sales-management.lists.edit', $contactList))->assertOk();
    $this->get(route('teamtnt.sales-management.pipelines.edit', $pipeline))->assertOk();
    $this->get(route('teamtnt.sales-management.campaign.edit', $campaign))->assertOk()->assertSee('Smoke campaign');
    $this->get(route('teamtnt.sales-management.dashboard'))->assertOk();
});
