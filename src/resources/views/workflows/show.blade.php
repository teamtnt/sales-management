@extends('sales-management::layouts.app')

@section('title', 'Workflows')

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ __('Show Workflow ') }}</h1>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ $workflow->name }}</h5>
                </div>
                <div class="card-body">
                    {{ $workflow->description }}
                </div>
            </div>
        </div>
    </div>
@stop

