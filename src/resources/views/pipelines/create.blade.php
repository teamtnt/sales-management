@extends('sales-management::layouts.app')

@section('title', 'Pipelines')
@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
    <li class="breadcrumb-item">{{ __('Pipelines') }}</li>
    <li class="breadcrumb-item active">{{ __('New Pipeline') }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ __('Add New Pipeline ') }}</h1>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{__("Pipeline form")}}</h5>
                        <h6 class="card-subtitle text-muted">{{__("Fill pipeline details below")}}</h6>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['method' => 'post', 'route' => 'teamtnt.sales-management.pipelines.store']) }}

                        @include('sales-management::pipelines.fields')

                        <div class="my-3">
                            <button type="submit" class="btn btn-success me-2"
                                    id="notyf-show">{{__("Create Pipeline")}}</button>
                             <a href="{{ route('teamtnt.sales-management.pipelines.index') }}" class="btn btn-danger">{{__("Cancel")}}</a>
                         </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
