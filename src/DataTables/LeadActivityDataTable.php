<?php

namespace Teamtnt\SalesManagement\DataTables;

use Teamtnt\SalesManagement\Models\Deal;
use Teamtnt\SalesManagement\Models\LeadActivity;
use Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class LeadActivityDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->filter(function ($query) {
                $query->where('created_by', auth()->id());
            }, true)
            ->editColumn('is_done', function (LeadActivity $leadActivity) {
                $toggleStatusUrl = route('lead-activities.toggle-status', $leadActivity);
                $icon = $leadActivity->is_done ? '<i class="fas fa-check-circle" style="color: green;"></i>' : '<i class="fas fa-times-circle" style="color: red;"></i>';
                return '<a href="' . $toggleStatusUrl . '">' . $icon . '</a>';
            })
            ->editColumn('lead.name', function (LeadActivity $leadActivity) {
                if ($leadActivity->lead) {
                    $url = route('contacts.edit', $leadActivity->lead->contact->id);
                    return '<a target="_blank" href="' . $url . '">' . $leadActivity->lead->contact->fullname . '</a>';
                }
                return '';
            })
            ->editColumn('lead.contact.phone', function (LeadActivity $leadActivity) {
                return $leadActivity->lead ? '<a href="tel:' . $leadActivity->lead->contact->phone . '">' . $leadActivity->lead->contact->phone . '</a>' : '';
            })
            ->editColumn('lead.contact.email', function (LeadActivity $leadActivity) {
                return $leadActivity->lead ? '<a href="mailto:' . $leadActivity->lead->contact->email . '">' . $leadActivity->lead->contact->email . '</a>' : '';
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
            ->filterColumn('type', function($query, $keyword) {
                $query->whereRaw("type like ?", ["%{$keyword}%"]);
            })
            ->rawColumns(['is_done', 'lead.name', 'lead.contact.phone', 'lead.contact.email', 'action']); // Add 'lead.contact.phone' and 'lead.contact.email' to rawColumns to render HTML
    }

    /**
     * Get query source of dataTable.
     *
     * @param LeadActivity $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(LeadActivity $model): QueryBuilder
    {
        return $model->newQuery()->with('user', 'lead', 'lead.campaign', 'lead.contact');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->dom('lfrtip')
            ->setTableId('deal-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addTableClass('table-striped')
            ->pageLength(25)
            ->orderBy(8, 'asc') // Set default order by 'start_date' asc
            ->language("https://cdn.datatables.net/plug-ins/1.13.1/i18n/de-DE.json");
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
        ];
    }

    protected function filename(): string
    {
        return 'LeadActivity_' . date('YmdHis');
    }
}
