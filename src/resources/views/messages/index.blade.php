@extends('sales-management::layouts.app')

@section('title', 'Messages')
@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
    <li class="breadcrumb-item">{{ __('Campaigns') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('teamtnt.sales-management.campaign.show', $campaign->id) }}">{{ __($campaign->name) }}</a>
    </li>
    <li class="breadcrumb-item active">{{ __('Messages') }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">{{ __('Messages') }}</h1>
        <div class="d-flex mb-3 justify-content-between align-items-center">
            @can(config('sales-management.permission_prefix').'.view-workflows')
                <a href="{{ route('teamtnt.sales-management.workflows.index', $campaign->id) }}" class="btn btn-info ">
                 <span class="d-flex align-items-center">
                    <x-sales-management::icons.workflow class="me-1"/> {{ __("Workflows") }}
                </span>
                </a>
            @endcan
            <a href="{{ route('teamtnt.sales-management.messages.create', $campaign) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> {{ __("New Message") }}
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    {!! $dataTable->scripts(attributes: ['type' => 'module']) !!}
@endpush
