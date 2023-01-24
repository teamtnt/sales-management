@extends('sales-management::layouts.app')

@section('title', 'Contacts')
@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
    <li class="breadcrumb-item active">{{ __('New Contact') }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ __('Add New Contact') }}</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                   Form
                </div>
            </div>
        </div>
    </div>
@stop
