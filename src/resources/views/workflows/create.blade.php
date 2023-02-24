@extends('sales-management::layouts.app')

@section('title', 'Workflows')

@section('add-css-class', 'overflow-hidden px-0 py-0')

@section('content')
    <work-flow
            save-url="{{ route('workflows.store', [$task->id])}}"
            workflow-title="Untitled Workflow"
            panel-title="Workflow"
            back-url="{{ route('workflows.index', [$task->id]) }}"
    ></work-flow>
@stop

