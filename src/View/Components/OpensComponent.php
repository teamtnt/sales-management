<?php

namespace Teamtnt\SalesManagement\View\Components;

use Illuminate\View\Component;
use Teamtnt\SalesManagement\Models\PostmarkEvent;

class OpensComponent extends Component
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
        $opensCount = PostmarkEvent::where('event_type', 'Open')->count();
        $deliveriesCount = PostmarkEvent::where('event_type', 'Delivery')->count();
        $openRate = $deliveriesCount > 0 ? ($opensCount / $deliveriesCount) * 100 : 0;

        return view('sales-management::components.dashboard.opens', compact('opensCount', 'openRate'));
    }


}
