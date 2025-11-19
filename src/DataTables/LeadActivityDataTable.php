<?php

namespace Teamtnt\SalesManagement\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Teamtnt\SalesManagement\Models\LeadActivity;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class LeadActivityDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->filter(function ($query) {
                // Debug: Log all request parameters
                \Log::info('Lead Activities Filter', [
                    'owner_filter' => request('owner_filter'),
                    'date_from' => request('date_from'),
                    'date_to' => request('date_to'),
                    'my_today' => request('my_today'),
                    'all_params' => request()->all(),
                ]);

                // Check if user has permission to view all activities
                $canViewAllActivities = auth()->user()->can(config('sales-management.permission_prefix').'.view-all-activities');

                // If user doesn't have view-all permission, only show their own activities
                if (! $canViewAllActivities) {
                    $query->where('created_by', auth()->id());
                }

                // Filter by owner if specified
                if (request()->has('owner_filter') && request('owner_filter') !== '') {
                    $query->where('created_by', request('owner_filter'));
                }

                // Filter by date range
                if (request()->has('date_from') && request('date_from') !== '') {
                    $query->whereDate('start_date', '>=', request('date_from'));
                }

                if (request()->has('date_to') && request('date_to') !== '') {
                    $query->whereDate('start_date', '<=', request('date_to'));
                }

                // Quick filter: my activities for today
                if (request()->has('my_today') && request('my_today') === '1') {
                    $query->where('created_by', auth()->id())
                        ->whereDate('start_date', today());
                }
            }, true)
            ->editColumn('is_done', function (LeadActivity $leadActivity) {
                $toggleStatusUrl = route('teamtnt.sales-management.lead-activities.toggle-status', $leadActivity);
                $icon = $leadActivity->is_done ? '<i class="fas fa-check-circle" style="color: green;"></i>' : '<i class="fas fa-times-circle" style="color: red;"></i>';

                return '<a href="'.$toggleStatusUrl.'">'.$icon.'</a>';
            })
            ->editColumn('lead.name', function (LeadActivity $leadActivity) {
                if ($leadActivity->lead) {
                    $url = route('teamtnt.sales-management.contacts.edit', $leadActivity->lead->contact->id);

                    return '<a target="_blank" href="'.$url.'">'.$leadActivity->lead->contact->fullname.'</a>';
                }

                return '';
            })
            ->editColumn('lead.contact.phone', function (LeadActivity $leadActivity) {
                return $leadActivity->lead ? '<a href="tel:'.$leadActivity->lead->contact->phone.'">'.$leadActivity->lead->contact->phone.'</a>' : '';
            })
            ->editColumn('lead.contact.email', function (LeadActivity $leadActivity) {
                return $leadActivity->lead ? '<a href="mailto:'.$leadActivity->lead->contact->email.'">'.$leadActivity->lead->contact->email.'</a>' : '';
            })
            ->editColumn('lead.contact.external_profile_url', function (LeadActivity $leadActivity) {
                return $leadActivity->lead ? '<a target="_blank" href="'.$leadActivity->lead->contact->external_profile_url.'">'.$leadActivity->lead->contact->external_profile_url.'</a>' : '';
            })
            ->editColumn('campaign.name', function (LeadActivity $leadActivity) {
                return $leadActivity->lead->campaign ? $leadActivity->lead->campaign->name : '';
            })
            ->editColumn('created_by', function (LeadActivity $leadActivity) {
                return $leadActivity->user->full_name;
            })
            ->editColumn('created_at', function (LeadActivity $leadActivity) {
                return $leadActivity->created_at ? $leadActivity->created_at->format('d.m.Y H:i') : '';
            })
            ->editColumn('start_date', function (LeadActivity $leadActivity) {
                return $leadActivity->start_date ? $leadActivity->start_date->format('d.m.Y H:i') : '';
            })
            ->editColumn('end_date', function (LeadActivity $leadActivity) {
                return $leadActivity->end_date ? $leadActivity->end_date->format('d.m.Y H:i') : '';
            })
            ->filterColumn('type', function ($query, $keyword) {
                $query->whereRaw('type like ?', ["%{$keyword}%"]);
            })
            ->rawColumns(['is_done', 'lead.name', 'lead.contact.phone', 'lead.contact.email', 'action', 'lead.contact.external_profile_url']); // Add 'lead.contact.phone' and 'lead.contact.email' to rawColumns to render HTML
    }

    /**
     * Get query source of dataTable.
     */
    public function query(LeadActivity $model): QueryBuilder
    {
        return $model->newQuery()->with('user', 'lead', 'lead.campaign', 'lead.contact');
    }

    /**
     * Optional method if you want to use html builder.
     */
    public function html(): HtmlBuilder
    {
        // Get all users who created activities
        $users = LeadActivity::select('created_by')->distinct()->with('user')->get()->pluck('user.full_name', 'created_by')->toArray();
        $usersJson = json_encode($users);

        return $this->builder()
            ->dom('lfrtip')
            ->setTableId('lead-activity-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'drawCallback' => 'function() { console.log("Table drawn"); }',
            ])
            ->addTableClass('table-striped')
            ->pageLength(25)
            ->orderBy(8, 'asc') // Set default order by 'start_date' asc
            ->language('https://cdn.datatables.net/plug-ins/1.13.1/i18n/de-DE.json')
            ->initComplete("

               function (settings, json) {

                this.api().columns([2]).every( function () {
                  var column = this;
                  // Use column title as label for select
                  var title = $(column.header()).text();

                  // Generate select
                  var select = $('<select class=\"form-control\"><option value=\"\">Alle</option></select>').appendTo( $(column.footer()).empty() )
                  // Search when selection is changed
                 .on( 'change', function () {
                    var val = $(this).val();
                    column.search( this.value ).draw();
                  } );
                  // Capture the data from the JSON to populate the select boxes with all the options
                  var extraData = (function(i) {

                  switch(i) {
                    case 2:
                        return $usersJson;
                  }
                  })(column.index());


                  // Draw select options
                  Object.entries(extraData).forEach( ([key, value]) => {
                    if(column.search() === key){
        select.append('<option value=\"' + key + '\" selected=\"selected\">' + value + '</option>');
    } else {
        select.append('<option value=\"' + key + '\">' + value + '</option>');
    }
                    } );
                } );
            }
            ");
    }

    protected function getColumns(): array
    {
        return [
            'id',
            'is_done',
            'created_by',
            'lead.name', // Add lead name
            'lead.contact.phone', // Add lead contact phone
            'lead.contact.email', // Add lead contact email
            'campaign.name', // Add campaign name
            'description',
            [
                'name' => 'start_date',
                'data' => 'start_date',
                'title' => 'Start Date',
                'orderable' => true,
            ],
            [
                'name' => 'end_date',
                'data' => 'end_date',
                'title' => 'End Date',
                'orderable' => true,
            ],
            'type',
            'lead.contact.external_profile_url',
        ];
    }

    protected function filename(): string
    {
        return 'LeadActivity_'.date('YmdHis');
    }
}
