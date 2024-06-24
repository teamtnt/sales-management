@extends('sales-management::layouts.app')

@section('title', 'Contacts')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teamtnt.sales-management.dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('teamtnt.sales-management.contacts.index') }}">{{ __('Contacts') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Create List') }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ __('Create List') }}</h1>
        <div class="row">
            <div class="col-md-12 col-lg-10 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        {!! Form::model(null, ['route' => ['teamtnt.sales-management.lists.store'], 'method' => 'POST',  'enctype'=>'multipart/form-data']) !!}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    {{ Form::label('name', __('Create new list'), ['class' => 'form-label']) }}
                                    {{ Form::text('name', null, ['class' => 'form-control '.($errors->has('name') ? ' is-invalid' : '') , 'placeholder' => __('Enter list name')]) }}
                                    @error('name')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary me-2">{{__("Create")}}</button>
                            <a href="{{ route('teamtnt.sales-management.lists.index') }}" class="btn btn-danger">{{__("Cancel")}}</a>
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
