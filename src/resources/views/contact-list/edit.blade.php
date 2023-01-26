@extends('sales-management::layouts.app')

@section('title', $contactList->name)
@section('breadcrumb')
   <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
   <li class="breadcrumb-item">{{ __('List') }}</li>
   <li class="breadcrumb-item active">{{ $contactList->name }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ $contactList->name }}</h1>
        <div class="row">
            <div class="col-12">
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
