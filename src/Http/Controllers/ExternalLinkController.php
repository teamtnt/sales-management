<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Illuminate\Http\Request;
use Teamtnt\SalesManagement\Models\Contact;
use Teamtnt\SalesManagement\Models\Lead;

class ExternalLinkController extends Controller
{
    /**
     * Find contact by UUID and redirect intelligently:
     * - If contact is in multiple campaigns: redirect to contact profile
     * - If contact is in only one campaign: redirect to campaign with search query
     * 
     * Usage: http://your-domain.com/sales/find/{uuid}
     * 
     * Example: http://primeros-bsha.test/sales/find/550e8400-e29b-41d4-a716-446655440000
     */
    public function findByUuid($uuid)
    {
        // Find contact by UUID
        $contact = Contact::where('uuid', $uuid)->first();

        if (!$contact) {
            abort(404, 'Contact not found');
        }

        // Get all leads (campaigns) for this contact
        $leads = Lead::where('contact_id', $contact->id)
            ->with('campaign')
            ->get();

        if ($leads->isEmpty()) {
            // Contact exists but has no leads - redirect to contact edit page
            return redirect()->route('teamtnt.sales-management.contacts.edit', ['contact' => $contact->id])
                ->with('info', 'This contact is not part of any campaign yet.');
        }

        if ($leads->count() > 1) {
            // Contact is in multiple campaigns - redirect to contact profile
            return redirect()->route('teamtnt.sales-management.contacts.edit', ['contact' => $contact->id])
                ->with('info', 'This contact is in multiple campaigns.');
        }

        // Contact is in exactly one campaign
        $lead = $leads->first();
        $campaign = $lead->campaign;

        // Build the search query parameter with the company name (most distinctive)
        $searchQuery = $contact->company_name ?: $contact->fullname;

        // Redirect to campaign with global search pre-filled
        return redirect()->route('teamtnt.sales-management.campaign.show', ['campaign' => $campaign->id])
            ->with('globalSearch', $searchQuery);
    }
}
