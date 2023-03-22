<?php

namespace Teamtnt\SalesManagement\View\Components;

use Illuminate\View\Component;
use Teamtnt\SalesManagement\Models\PostmarkEvent;

class BouncesComponent extends Component
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
        $bouncesCount = PostmarkEvent::where('event_type', 'Bounce')->count();
        $sentCount = PostmarkEvent::where('event_type', 'Sent')->count();
        $bounceRate = $sentCount > 0 ? ($bouncesCount / $sentCount) * 100 : 0;

        return view('sales-management::components.dashboard.bounces', compact('bouncesCount', 'bounceRate'));
    }


}
