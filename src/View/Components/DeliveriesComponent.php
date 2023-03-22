<?php

namespace Teamtnt\SalesManagement\View\Components;

use Illuminate\View\Component;
use Teamtnt\SalesManagement\Models\PostmarkEvent;

class DeliveriesComponent extends Component
{
    public $course;

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
        $sentCount = PostmarkEvent::where('event_type', 'Sent')->count();
        $deliveriesCount = PostmarkEvent::where('event_type', 'Delivery')->count();
        $deliveryRate = $sentCount > 0 ? ($deliveriesCount / $sentCount) * 100 : 0;

        return view('sales-management::components.dashboard.deliveries', compact('deliveriesCount', 'deliveryRate'));
    }


}
