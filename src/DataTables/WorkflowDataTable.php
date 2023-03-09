<?php

namespace Teamtnt\SalesManagement\DataTables;

use Teamtnt\SalesManagement\Models\Workflow;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class WorkflowDataTable extends DataTable
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
            ->editColumn('status', function (Workflow $workflow) {
                return collect([
                    0 => __('Unpublished'),
                    1 => __('Published'),
                ])->get($workflow->status);
            })
            ->addColumn('action', 'sales-management::workflows.actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Workflow  $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Workflow $model): QueryBuilder
    {
        return $model->newQuery()->whereCampaignId($this->campaignId);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        $lang = app()->getLocale().'-'.strtoupper(app()->getLocale());

        return $this->builder()
            ->dom('lfrtip')
            ->setTableId('workflow-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addTableClass('table-striped')
            ->orderBy(1)
            ->language("https://cdn.datatables.net/plug-ins/1.13.1/i18n/$lang.json");
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [

            Column::make('id')->title('ID'),
            Column::make('name')->title(__('Name')),
            Column::make('status')->title(__('Status')),
            Column::make('description')->title(__('Description')),

            Column::computed('action')
                ->with('campaignId', $this->campaignId)
                ->exportable(false)
                ->printable(false)
                ->width(300)
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
        return 'Workflow_'.date('YmdHis');
    }
}
