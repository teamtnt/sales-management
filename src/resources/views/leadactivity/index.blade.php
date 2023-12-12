@extends('sales-management::layouts.app')

@section('content')
    {!! $dataTable->table([], true) !!}

@endsection

@push('scripts')
    {!! $dataTable->scripts(attributes: ['type' => 'module']) !!}
@endpush
