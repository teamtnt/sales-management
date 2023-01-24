@extends('sales-management::layouts.app')

@section('title', 'Contacts')
@section('breadcrumb')
   <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
   <li class="breadcrumb-item active">{{ __('Contacts') }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ __('All Contacts') }}</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {!! $dataTable->table(['class' => 'table table-striped ']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endpush
