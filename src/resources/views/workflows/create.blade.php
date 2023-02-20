@extends('sales-management::layouts.app')

@section('title', 'Workflows')
@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
    <li class="breadcrumb-item">{{ __('Tasks') }}</li>
    <li class="breadcrumb-item">{{ __($task->name) }}</li>
    <li class="breadcrumb-item">{{ __('Workflows') }}</li>
    <li class="breadcrumb-item active">{{ __('Create Workflow') }}</li>
@endsection
@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ __('Add New Workflow ') }}</h1>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{__("Workflow Form")}}</h5>
                        <h6 class="card-subtitle text-muted">{{__("Fill workflow details below")}}</h6>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['method' => 'post', 'route' => ['workflows.store', $task]]) }}

                        @include('sales-management::workflows.fields')

                        <div class="my-3">
                            <button type="submit" class="btn btn-success me-2"
                                    id="notyf-show">{{__("Create Workflow")}}</button>
                            <a href="{{ route('workflows.index', $task) }}" class="btn btn-danger">{{__("Cancel")}}</a>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
