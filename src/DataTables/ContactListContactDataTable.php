<?php

namespace Teamtnt\SalesManagement\DataTables;

use Teamtnt\SalesManagement\Models\Contact;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Teamtnt\SalesManagement\Models\ContactList;
use Teamtnt\SalesManagement\Models\ContactListContact;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ContactListContactDataTable extends DataTable
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
            ->addColumn('action', 'sales-management::contact-list-contacts.actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param Contact $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ContactListContact $model): QueryBuilder
    {
        $modelTable = $model->getTable();
        $id = $modelTable.'.contact_id';
        $joinTable = (new Contact())->getTable();
        $joinColumn = $joinTable.'.id';

        return $model->select([$modelTable.'.id as contact_list_contact_id', $joinTable.'.*'])
            ->join($joinTable, $joinColumn, $id);
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

            Column::make('contact_list_contact_id')->title('ID'),
            Column::make('firstname')->title(__('First name')),
            Column::make('lastname')->title(__('Last name')),
            Column::make('job_title')->title(__('Job title')),
            Column::make('email')->title('Email'),
            Column::make('phone')->title(__('Phone')),
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
        return 'Contact_' . date('YmdHis');
    }
}
