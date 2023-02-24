@extends('sales-management::layouts.app')

@section('title', 'Workflows')
@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
    <li class="breadcrumb-item">{{ __('Tasks') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('tasklist.show', $task->id) }}">{{ __($task->name) }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('workflows.index', $task->id) }}">{{ __('Workflows') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Create Workflow') }}</li>
@endsection
@section('add-css-class', 'overflow-hidden')

@section('content')
    <work-flow
            save-url="{{ route('workflows.store', [$task->id])}}"
            workflow-title="Untitled Workflow"
            panel-title="Workflow"
            back-url="{{ route('workflows.index', [$task->id]) }}"
    ></work-flow>
@stop

