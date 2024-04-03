@extends('sales-management::layouts.app')

@section('title', 'Contacts')
@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
    <li class="breadcrumb-item">{{ __('Contacts') }}</li>
    <li class="breadcrumb-item active">{{ __('Edit Contact') }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ __('Edit Contact') }}</h1>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{__("Contact form")}}</h5>
                        <h6 class="card-subtitle text-muted">{{__("Fill contacts details below")}}</h6>
                    </div>
                    <div class="card-body">
                        {{ Form::model($contact, ['method' => 'PUT', 'route' => ['teamtnt.sales-management.contacts.update', $contact->id]]) }}

                        @include('sales-management::contacts.fields')

                        <div class="my-3">
                            <button type="submit" class="btn btn-success me-2"
                                    id="notyf-show">{{__("Update Contact")}}</button>
                            <a href="{{ route('teamtnt.sales-management.contacts.index') }}"
                               class="btn btn-info">{{__("Back")}}</a>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{__("In Campaigns")}}</h5>
                        <h6 class="card-subtitle text-muted"></h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>{{__("Campaign")}}</th>
                                <th>Pipeline</th>
                                <th>Stage</th>
                            </tr>
                            </thead>
                            <tr>
                                @foreach($contact->leads as $lead)
                                    <td>
                                        @if($lead->campaign)
                                            <a href="{{ route('teamtnt.sales-management.campaign.show', $lead->campaign->id) }}">{{ $lead->campaign->name }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $lead->pipeline->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $lead->stage->name ?? 'Leads' }}
                                    </td>

                                @endforeach
                            </tr>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

