@extends('sales-management::layouts.app')

@section('title', 'Messages')
@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
    <li class="breadcrumb-item">{{ __('Campaigns') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('teamtnt.sales-management.campaign.show', $campaign->id) }}">{{ __($campaign->name) }}</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('teamtnt.sales-management.messages.index', $campaign->id) }}">{{ __('Messages') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Edit Message') }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ __('Edit Message') }}</h1>
        <div class="row">
            <div class="col-12 col-md-10 ">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{__("Message form")}}</h5>
                        <h6 class="card-subtitle text-muted">{{__("Fill message details below")}}</h6>
                    </div>
                    <div class="card-body">
                        {{ Form::model($message, ['method' => 'PUT', 'route' => ['messages.update', [$campaign, $message->id]]]) }}

                        @include('sales-management::messages.fields')

                        <div class="my-3">
                            <button type="submit" class="btn btn-success me-2"
                                    id="notyf-show">{{__("Update Message")}}</button>
                            <a href="{{ route('teamtnt.sales-management.messages.index', $campaign) }}" class="btn btn-danger">{{__("Back")}}</a>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

