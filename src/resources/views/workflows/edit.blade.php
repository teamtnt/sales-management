@extends('sales-management::layouts.app')

@section('title', 'Workflows')
 
@section('add-css-class', 'overflow-hidden px-0 py-0')

@section('content')
    <work-flow
            save-url="{{ route('workflows.update', [$task->id, $workflow->id]) }}"
            cancel-url="{{ route('workflows.index', [$task->id]) }}"
            workflow-title="{{ $workflow->name }}"
            panel-title="{{ $workflow->name }}"
            :elements-data="{{ $workflow->elements ?? json_encode([]) }}"
    ></work-flow>
@endsection

