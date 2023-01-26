@extends('sales-management::layouts.app')

@section('content')
    <a href="{{ route('automation.workflow.new') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> {{ __("New Workflow") }}</a>
    <h1 class="h3 mb-3">{{ __("Workflows") }}</h1>

@stop
