@extends('sales-management::layouts.app')

@section('title', 'Workflows')
@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
    <li class="breadcrumb-item">{{ __('Tasks') }}</li>
    <li class="breadcrumb-item">{{ __($task->name) }}</li>
@endsection
@section('content')
    <div class="container-fluid p-0">
        <a href="{{ route('automation.workflow.new') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> {{ __("New Workflow") }}</a>
        <h1 class="h3 mb-3">{{ __('Workflows ') }}</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column flex-md-row">
                        <div class="mt-2">
                            <a class="btn btn-primary" href="{{ route('workflows.create', $task) }}">
                                <i class="align-middle me-2 fas fa-fw fa-stream"></i> {{__("Create New Workflow")}}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts(attributes: ['type' => 'module']) !!}
@endpush
