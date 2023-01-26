@extends('sales-management::layouts.app')

@section('title', 'Contacts')
@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
    <li class="breadcrumb-item">{{ __('Contacts') }}</li>
    <li class="breadcrumb-item active">{{ __('Import CSV') }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ __('Import Contacts from a CSV file') }}</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-between">
                    </div>
                    <div class="card-body">
                        {{ Form::open(['method' => 'post', 'route' => 'contacts.import.csv.store']) }}
                        <input type="file" name="csv">

                        <label for="">Import to list</label>
                        <select name="" id="">
                            <option value="">{{__("Default")}}</option>
                        </select>
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
