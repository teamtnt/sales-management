@extends('sales-management::layouts.app')

@section('title', 'Workflows')
@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
    <li class="breadcrumb-item">{{ __('Tasks') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('tasklist.show', $task->id) }}">{{ __($task->name) }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('workflows.index', $task->id) }}">{{ __('Workflows') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Edit Workflow') }}</li>
@endsection

@section('add-css-class', 'overflow-hidden')

@section('content')
    <work-flow
            save-url="{{ route('workflows.update', [$task->id, $workflow->id]) }}"
            workflow-title="{{ $workflow->name }}"
            panel-title="{{ $workflow->name }}"
            :elements-data="{{ $workflow->elements ?? json_encode([]) }}"
    ></work-flow>
@endsection

