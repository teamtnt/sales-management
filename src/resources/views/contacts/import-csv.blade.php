@extends('sales-management::layouts.app')

@section('title', 'Contacts')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('contacts.index') }}">{{ __('Contacts') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Import CSV') }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ __('Import Contacts from a CSV file') }}</h1>
        <div class="row">
            <div class="col-md-12 col-lg-10 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        {!! Form::model(null, ['route' => ['contacts.import.csv.store'], 'method' => 'POST',  'enctype'=>'multipart/form-data']) !!}
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <div class="mb-3 {{($errors->has('csv') ? ' is-invalid' : '')}}">
                                    <label for="formFile" class="form-label">Upload CSV</label>
                                    <input class="form-control" type="file" id="formFile" name="csv">
                                </div>
                                @error('csv')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="list" class="form-label">Import to list</label>
                                    <select class="form-select" aria-label="Default select example" id="list">
                                        <option selected>{{ __('Default') }}</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="d-inline-flex align-items-center w-100 h-100 mt-1">
                                    <div class="page-separator d-flex justify-content-center my-1 w-100">
                                        <span class="page-separator__text">Or</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    {{ Form::label('new_list', __('Create as new list'), ['class' => 'form-label']) }}
                                    {{ Form::text('new_list', null, ['class' => 'form-control '.($errors->has('new_list') ? ' is-invalid' : '') , 'placeholder' => __('Enter list name')]) }}
                                    @error('new_list')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary me-2">{{__("Import CSV")}}</button>
                            <a href="{{ route('contacts.index') }}" class="btn btn-danger">{{__("Cancel")}}</a>
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
