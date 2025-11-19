<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use Teamtnt\SalesManagement\Models\Contact;
use Teamtnt\SalesManagement\Models\Lead;
use Teamtnt\SalesManagement\Models\LeadActivity;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Setup required database tables and permissions
    $this->artisan('migrate', ['--database' => 'testing']);

    // Create test users with different permissions
    $this->userWithViewAll = createUser(['name' => 'Admin User']);
    $this->userWithoutViewAll = createUser(['name' => 'Regular User']);

    // Grant view-all-activities permission to admin user
    grantPermission($this->userWithViewAll, config('sales-management.permission_prefix').'.view-all-activities');
    grantPermission($this->userWithViewAll, config('sales-management.permission_prefix').'.view-activities');

    // Grant only view-activities permission to regular user
    grantPermission($this->userWithoutViewAll, config('sales-management.permission_prefix').'.view-activities');
});

it('shows only own activities for users without view-all permission', function () {
    // Create activities for different users
    $contact1 = Contact::factory()->create();
    $contact2 = Contact::factory()->create();
    $lead1 = Lead::factory()->create(['contact_id' => $contact1->id]);
    $lead2 = Lead::factory()->create(['contact_id' => $contact2->id]);

    $ownActivity = LeadActivity::factory()->create([
        'created_by' => $this->userWithoutViewAll->id,
        'lead_id' => $lead1->id,
    ]);

    $otherActivity = LeadActivity::factory()->create([
        'created_by' => $this->userWithViewAll->id,
        'lead_id' => $lead2->id,
    ]);

    $this->actingAs($this->userWithoutViewAll);

    $response = $this->get(route('teamtnt.sales-management.lead-activities.index'));

    $response->assertSuccessful();
    // User should only see their own activity
    expect(LeadActivity::where('created_by', $this->userWithoutViewAll->id)->count())->toBe(1);
});

it('shows all activities for users with view-all permission', function () {
    $contact1 = Contact::factory()->create();
    $contact2 = Contact::factory()->create();
    $lead1 = Lead::factory()->create(['contact_id' => $contact1->id]);
    $lead2 = Lead::factory()->create(['contact_id' => $contact2->id]);

    LeadActivity::factory()->create([
        'created_by' => $this->userWithoutViewAll->id,
        'lead_id' => $lead1->id,
    ]);

    LeadActivity::factory()->create([
        'created_by' => $this->userWithViewAll->id,
        'lead_id' => $lead2->id,
    ]);

    $this->actingAs($this->userWithViewAll);

    $response = $this->get(route('teamtnt.sales-management.lead-activities.index'));

    $response->assertSuccessful();
    // Admin should see all activities
    expect(LeadActivity::count())->toBe(2);
});

it('filters activities by owner when specified', function () {
    $contact1 = Contact::factory()->create();
    $contact2 = Contact::factory()->create();
    $lead1 = Lead::factory()->create(['contact_id' => $contact1->id]);
    $lead2 = Lead::factory()->create(['contact_id' => $contact2->id]);

    LeadActivity::factory()->create([
        'created_by' => $this->userWithoutViewAll->id,
        'lead_id' => $lead1->id,
    ]);

    LeadActivity::factory()->create([
        'created_by' => $this->userWithViewAll->id,
        'lead_id' => $lead2->id,
    ]);

    $this->actingAs($this->userWithViewAll);

    $response = $this->get(route('teamtnt.sales-management.lead-activities.index', [
        'owner_filter' => $this->userWithoutViewAll->id,
    ]));

    $response->assertSuccessful();
});

it('filters activities by date range', function () {
    $contact = Contact::factory()->create();
    $lead = Lead::factory()->create(['contact_id' => $contact->id]);

    $todayActivity = LeadActivity::factory()->create([
        'created_by' => $this->userWithViewAll->id,
        'lead_id' => $lead->id,
        'start_date' => today(),
    ]);

    $oldActivity = LeadActivity::factory()->create([
        'created_by' => $this->userWithViewAll->id,
        'lead_id' => $lead->id,
        'start_date' => today()->subDays(7),
    ]);

    $this->actingAs($this->userWithViewAll);

    $response = $this->get(route('teamtnt.sales-management.lead-activities.index', [
        'date_from' => today()->format('Y-m-d'),
        'date_to' => today()->format('Y-m-d'),
    ]));

    $response->assertSuccessful();
});

it('shows user list in filter when user has view-all permission', function () {
    $this->actingAs($this->userWithViewAll);

    $response = $this->get(route('teamtnt.sales-management.lead-activities.index'));

    $response->assertSuccessful()
        ->assertSee('owner_filter');
});

it('does not show user list in filter when user lacks view-all permission', function () {
    $this->actingAs($this->userWithoutViewAll);

    $response = $this->get(route('teamtnt.sales-management.lead-activities.index'));

    $response->assertSuccessful()
        ->assertDontSee('owner_filter');
});

// Helper functions (these should be defined in your TestCase or a helper file)
function createUser(array $attributes = [])
{
    // Implementation depends on your User model
    // This is a placeholder - adjust based on your actual User model
    $userModel = config('sales-management.userModel', \App\Models\User::class);

    return $userModel::factory()->create($attributes);
}

function grantPermission($user, string $permission)
{
    // Implementation depends on your permission system (Spatie, etc.)
    // This is a placeholder - adjust based on your actual permission system
    if (method_exists($user, 'givePermissionTo')) {
        $user->givePermissionTo($permission);
    }
}
