<?php

namespace Teamtnt\SalesManagement\View\Components;

use Illuminate\View\Component;
use Teamtnt\SalesManagement\Models\Contact;

class TotalContactsComponent extends Component
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
        $totalContactsCount = Contact::count();

        $currentMonthContactsCount = Contact::whereMonth('created_at', '=', now()->month)
            ->whereYear('created_at', '=', now()->year)
            ->count();

        $previousMonthContactsCount = Contact::whereMonth('created_at', '=', now()->subMonth()->month)
            ->whereYear('created_at', '=', now()->subMonth()->year)
            ->count();

        $contactsDifference = $currentMonthContactsCount - $previousMonthContactsCount;
        $percentageIncrease = $previousMonthContactsCount > 0 ? ($contactsDifference / $previousMonthContactsCount) * 100 : 0;

        return view('sales-management::components.dashboard.total-contacts', compact('totalContactsCount', 'percentageIncrease'));
    }


}
