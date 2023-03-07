@extends('sales-management::layouts.app')

@section('title', 'Tags')
@section('breadcrumb')
   <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
   <li class="breadcrumb-item active">{{ __('Tags') }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3">
            <h1 class="h3 mb-0">{{ __('All Tags') }}</h1>

                <a class="btn btn-primary" href="{{ route('tags.create') }}">
                    <i class="align-middle fas fa-fw fa-plus"></i> {{__("Create New Tag")}}</a>

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
