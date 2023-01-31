<?php

namespace Teamtnt\SalesManagement\DataTables;

use Teamtnt\SalesManagement\Models\Company;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CompanyDataTable extends DataTable
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
            ->addColumn('action', 'sales-management::companies.actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param  Company  $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Company $model): QueryBuilder
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
            ->setTableId('contact-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addTableClass('table-striped')
            ->orderBy(1)
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

            Column::make('id')->title('ID'),
            Column::make('name')->title(__('Name')),
            Column::make('vat')->title(__('VAT')),
            Column::make('url')->title(__('Url')),
            Column::make('email')->title('Email'),
            Column::make('address')->title(__('Address')),
            Column::make('postal')->title(__('ZIP')),
            Column::make('city')->title(__('City')),
            Column::make('country')->title(__('Country')),
            Column::computed('action')
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
        return 'Contact_'.date('YmdHis');
    }
}
