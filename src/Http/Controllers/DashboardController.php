<?php

namespace Teamtnt\SalesManagement\Http\Controllers;

use Teamtnt\SalesManagement\Models\Company;
use Teamtnt\SalesManagement\Models\Contact;
use Teamtnt\SalesManagement\Models\PostmarkEvent;
use \DatePeriod;
use \DateInterval;
use Teamtnt\SalesManagement\Models\Status;

class DashboardController extends Controller
{

    public function index()
    {
        $events = PostmarkEvent::orderBy('created_at', 'DESC')->paginate(50);

        $chartData = $this->getChartData();

        return view('sales-management::dashboard.index', compact('events', 'chartData'));
    }

    public function getChartData()
    {
        $startDate = now()->subDays(30);
        $endDate = now();

        $dateRange = new DatePeriod(
            $startDate,
            new DateInterval('P1D'),
            $endDate
        );

        $opensData = [];
        $clicksData = [];
        $labels = [];

        foreach ($dateRange as $date) {
            $opens = PostmarkEvent::where('event_type', 'Open')
                ->whereDate('created_at', $date)
                ->count();

            $clicks = PostmarkEvent::where('event_type', 'Click')
                ->whereDate('created_at', $date)
                ->count();

            $opensData[] = $opens;
            $clicksData[] = $clicks;
            $labels[] = $date->format('Y-m-d');
        }

        return [
            'labels' => $labels,
            'opens' => $opensData,
            'clicks' => $clicksData,
        ];
    }
}

