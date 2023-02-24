@extends('sales-management::layouts.app')

@section('title', 'Workflows')

@section('add-css-class', 'overflow-hidden px-0 py-0')

@section('content')
    <work-flow
            save-url="{{ route('workflows.store', [$task->id])}}"
            workflow-title="Unitled Workflow - Tome Stiliziraj da bude pokraj:)"
            panel-title="Workflow"
    ></work-flow>
@stop

