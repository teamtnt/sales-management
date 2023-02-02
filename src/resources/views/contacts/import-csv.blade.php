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
            <div class="col-md-12 col-lg-10 col-xl-8 col-xxl-6">
                <div class="card">
                    <div class="card-body">
                        {!! Form::model(null, ['route' => ['contacts.import.csv.store'], 'method' => 'POST',  'enctype'=>'multipart/form-data']) !!}
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Upload CSV</label>
                                    <input class="form-control" type="file" id="formFile" name="csv">
                                </div>
                            </div>
                            <div class="col-md-5">
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
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary me-2" >{{__("Import CSV")}}</button>
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
