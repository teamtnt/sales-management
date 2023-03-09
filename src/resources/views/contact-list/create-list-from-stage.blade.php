@extends('sales-management::layouts.app')

@section('title', 'Contacts')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('contacts.index') }}">{{ __('Contacts') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Create List From Stage') }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ __('Import Contacts from a CSV file') }}</h1>
        <div class="row">
            <div class="col-md-12 col-lg-10 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        {!! Form::model(null, ['route' => ['lists.create.from.stage.store'], 'method' => 'POST',  'enctype'=>'multipart/form-data']) !!}
                        {{ Form::hidden('campaign_id', $campaignId) }}
                        {{ Form::hidden('stage_id', $pipelineStageId) }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    {{ Form::label('new_list', __('Create new list'), ['class' => 'form-label']) }}
                                    {{ Form::text('new_list', null, ['class' => 'form-control '.($errors->has('new_list') ? ' is-invalid' : '') , 'placeholder' => __('Enter list name')]) }}
                                    @error('new_list')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary me-2">{{__("Create List CSV")}}</button>
                            <a href="{{ route('campaign.show', $campaignId) }}"
                               class="btn btn-danger">{{__("Cancel")}}</a>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
@endpush
