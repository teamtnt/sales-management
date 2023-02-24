@extends('sales-management::layouts.app')

@section('title', 'Workflow')

@section('add-css-class', 'overflow-hidden px-0 py-0')

@section('content')
    <work-flow
            save-url="/automation/workflow/save"
            panel-title="Workflow"
    ></work-flow>
@stop
