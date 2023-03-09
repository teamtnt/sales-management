@extends('sales-management::layouts.app')

@section('title', 'Workflows')
@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
    <li class="breadcrumb-item">{{ __('Campaigns') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('campaign.show', $campaign->id) }}">{{ __($campaign->name) }}</a>
    </li>
    <li class="breadcrumb-item active">{{ __('Workflows') }}</li>
@endsection
@section('content')
    <div class="container-fluid p-0">
        <a href="{{ route('workflows.create', $campaign) }}" class="btn btn-primary float-end mt-n1">
            <i class="fas fa-plus"></i> {{__("New Workflow")}}
        </a>
        <h1 class="h3 mb-3">{{ __('Workflows') }}</h1>
        <div class="d-flex mb-3 justify-content-between align-items-center">
            <a href="{{ route('messages.index', $campaign->id) }}" class="btn btn-info">
                 <span class="d-flex align-items-center">
                    <x-sales-management::icons.mail class="me-1"/> {{ __("Messages") }}
                </span>
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
@endsection

@push('scripts')
    {!! $dataTable->scripts(attributes: ['type' => 'module']) !!}
@endpush
