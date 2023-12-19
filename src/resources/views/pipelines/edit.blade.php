@extends('sales-management::layouts.app')

@section('title', 'Pipelines')
@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
    <li class="breadcrumb-item">{{ __('Pipeline') }}</li>
    <li class="breadcrumb-item active">{{ __('Edit Pipeline') }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ __('Edit Pipeline') }}</h1>
        <div class="row">
            <div class="col-12 col-md-10 ">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{__("Contact form")}}</h5>
                        <h6 class="card-subtitle text-muted">{{__("Fill pipeline details below")}}</h6>
                    </div>
                    <div class="card-body">
                        {{ Form::model($pipeline, ['method' => 'PUT', 'route' => ['pipelines.update', $pipeline->id]]) }}

                        @include('sales-management::pipelines.fields')

                        <div class="my-3">
                            <button type="submit" class="btn btn-success me-2"
                                    id="notyf-show">{{__("Update Pipeline")}}</button>
                             <a href="{{ route('teamtnt.sales-management.pipelines.index') }}" class="btn btn-info">{{__("Back")}}</a>
                         </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

