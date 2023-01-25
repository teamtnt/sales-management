@extends('sales-management::layouts.app')

@section('title', 'Contacts')
@section('breadcrumb')
   <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
   <li class="breadcrumb-item active">{{ __('Contacts') }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ __('All Contacts') }}</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                     <div class="card-header d-flex flex-column flex-md-row justify-content-between">
                        <div>
                            <a class="btn btn-info me-2" href="">
                                <i class="align-middle me-2 fas fa-fw fa-users"></i> {{__("Import Contacts")}}</a>
                             <a class="btn btn-info" href="">
                                <i class="align-middle me-2 fas fa-fw fa-file-excel"></i> {{__("Import from CSV")}}</a>
                        </div>
                        <div class="mt-2">
                            <a class="btn btn-primary" href="{{ route('contacts.create') }}">
                                <i class="align-middle me-2 fas fa-fw fa-user-plus"></i> {{__("Create New Contact")}}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    {!! $dataTable->scripts(attributes: ['type' => 'module']) !!}
@endpush
