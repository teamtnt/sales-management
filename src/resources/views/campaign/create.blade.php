@extends('sales-management::layouts.app')

@section('title', 'Campaigns')
@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
    <li class="breadcrumb-item">{{ __('Campaigns') }}</li>
    <li class="breadcrumb-item active">{{ __('New Campaign') }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ __('Create new campaign') }}</h1>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{__("Campaign form")}}</h5>
                        <h6 class="card-subtitle text-muted">{{__("Add campaign details bellow")}}</h6>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['method' => 'post', 'route' => 'teamtnt.sales-management.campaign.store']) }}

                        @include('sales-management::campaign.fields')

                        <div class="my-3">
                            <button type="submit" class="btn btn-success me-2"
                                    id="notyf-show">{{__("Create Campaign")}}</button>
                            <a href="{{ route('teamtnt.sales-management.campaign.index') }}" class="btn btn-danger">{{__("Cancel")}}</a>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
