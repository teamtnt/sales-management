<?php

namespace Teamtnt\SalesManagement\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Teamtnt\SalesManagement\Models\Campaign;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;

class CampaignDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('assignee', function (Campaign $campaign) {
                return $campaign->assignees->implode('email', ', ');
            })
            ->editColumn('name', function (Campaign $campaign) {
                return '<a href="'.route('campaign.show', $campaign).'">'.$campaign->name.'</a>';
            })
            ->editColumn('updated_at', function (Campaign $campaign) {
                return $campaign->updated_at->format('d.m.Y');
            })
            ->editColumn('status', function (Campaign $campaign) {
                return Campaign::getCampaignStatusNames()[$campaign->status] ?? '--';
            })
            ->addColumn('contact_list.name', function (Campaign $campaign) {
                return '<a href="'.route('lists.edit', $campaign->contactList->id).'">'.$campaign->contactList->name.'</a>' ?? '--';
            })
            ->addColumn('action', 'sales-management::campaign.actions')
            ->rawColumns(['name', 'action','contact_list.name'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Campaign  $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Campaign $model): QueryBuilder
    {
        return $model->newQuery();
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
            ->setTableId('campaign-list-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addTableClass('table-striped')
            ->orderBy(2)
            ->language("https://cdn.datatables.net/plug-ins/1.13.1/i18n/de-DE.json");
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::computed('name')->title(__('Name')),
            Column::make('updated_at')->title(__('Updated')),
            Column::make('status')->title(__('Status')),
            Column::make('assignee')->title(__('Assignee')),
            Column::make('contact_list.name')->title(__('Contact List')),
            Column::computed('action')->title(__('Action'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Campaign_'.date('YmdHis');
    }
}
