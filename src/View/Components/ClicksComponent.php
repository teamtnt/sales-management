<?php

namespace Teamtnt\SalesManagement\View\Components;

use Illuminate\View\Component;
use Teamtnt\SalesManagement\Models\PostmarkEvent;

class ClicksComponent extends Component
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
        $clicksCount = PostmarkEvent::where('event_type', 'Click')->count();
        $deliveriesCount = PostmarkEvent::where('event_type', 'Delivery')->count();
        $clickRate = $deliveriesCount > 0 ? ($clicksCount / $deliveriesCount) * 100 : 0;

        return view('sales-management::components.dashboard.clicks', compact('clicksCount', 'clickRate'));
    }


}
