<?php

namespace Teamtnt\SalesManagement\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Teamtnt\SalesManagement\Models\ContactList;
use Teamtnt\SalesManagement\Models\ContactListContacts;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;

class ContactListDataTable extends DataTable
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
            ->addColumn('action', 'sales-management::contact-list.actions')
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param ContactList $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ContactList $model): QueryBuilder
    {
        $id = $model->getTable().'.id';
        $joinTable = (new ContactListContacts)->getTable();
        $joinColumn = $joinTable.'.contact_list_id';
        $count = $joinTable.'.contact_list_id';
        $groupBy = $model->getTable().'.id';

        return $model->select([$id, 'name', 'description', DB::raw("COUNT($count) as count")])
            ->join($joinTable, $joinColumn, $id)
            ->groupBy([$groupBy]);
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
            ->setTableId('contact-list-table')
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

            Column::make('id'),
            Column::make('name')->title(__('Name')),
            Column::make('description')->title(__('Description')),
            Column::make('count')->title(__('Count')),
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
        return 'ContactList_' . date('YmdHis');
    }
}
