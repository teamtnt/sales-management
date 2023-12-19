@extends('sales-management::layouts.app')

@section('title', 'Pipelines')
@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
    <li class="breadcrumb-item active">{{ __('Pipelines') }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ __('All Pipelines') }}</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                     <div class="card-header d-flex flex-column flex-md-row">
                        <div class="mt-2">
                            <a class="btn btn-primary" href="{{ route('teamtnt.sales-management.pipelines.create') }}">
                                <i class="align-middle me-2 fas fa-fw fa-stream"></i> {{__("Create New Pipeline")}}</a>
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
