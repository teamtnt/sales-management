@extends('sales-management::layouts.app')

@section('content')
    {!! $dataTable->table() !!}

@endsection

@push('scripts')
    {!! $dataTable->scripts(attributes: ['type' => 'module']) !!}
@endpush
