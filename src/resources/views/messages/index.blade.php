@extends('sales-management::layouts.app')

@section('title', 'Messages')
@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
    <li class="breadcrumb-item">{{ __('Tasks') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('tasklist.show', $task->id) }}">{{ __($task->name) }}</a></li>
    <li class="breadcrumb-item active">{{ __('Messages') }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <a href="{{ route('messages.create', $task) }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> {{ __("New Message") }}</a>
        <h1 class="h3 mb-3">{{ __('All Messages') }}</h1>
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
