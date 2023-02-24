@extends('sales-management::layouts.app')

@section('title', 'Workflows')

@section('add-css-class', 'overflow-hidden px-0 py-0')

@section('content')
    <work-flow
        save-url="{{ route('workflows.save-elements', [$task->id, $workflow->id]) }}"
        panel-title="{{ $workflow->name }}"
        :elements-data="{{ $workflow->elements ?? json_encode([]) }}"
    ></work-flow>
@stop

