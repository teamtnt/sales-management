<?php

namespace Teamtnt\SalesManagement\DataTables;

use Illuminate\Support\Collection;
use Teamtnt\SalesManagement\Models\Contact;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Teamtnt\SalesManagement\Models\ContactList;
use Teamtnt\SalesManagement\Models\ContactListContact;
use Yajra\DataTables\CollectionDataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ContactListContactDataTable extends DataTable
{

    public function dataTable(): CollectionDataTable
    {
        return (new CollectionDataTable($this->collection()))
            ->addColumn('action', 'sales-management::contact-list-contacts.actions');
    }

    public function collection(): Collection
    {
        return $this->contactList->contacts()->withPivot(['id'])->get();
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
        return 'Contact_'.date('YmdHis');
    }
}
