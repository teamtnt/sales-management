<?php

namespace Teamtnt\SalesManagement\View\Components;

use Illuminate\View\Component;
use Teamtnt\SalesManagement\Models\PostmarkEvent;

class SpamComplaintsComponent extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $spamComplaintsCount = PostmarkEvent::where('event_type', 'SpamComplaint')->count();
        $sentCount = PostmarkEvent::where('event_type', 'Sent')->count();
        $spamComplaintRate = $sentCount > 0 ? ($spamComplaintsCount / $sentCount) * 100 : 0;

        return view('sales-management::components.dashboard.spam-complaints', compact('spamComplaintsCount', 'spamComplaintRate'));
    }
}
