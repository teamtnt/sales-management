@extends('sales-management::layouts.app')

@section('title', 'Deals')
@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
    <li class="breadcrumb-item">{{ __('Deal') }}</li>
    <li class="breadcrumb-item active">{{ __('Edit Deal') }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ __('Edit Deal') }}</h1>
        <div class="row">
            <div class="col-12 col-md-10 ">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{__("Deal form")}}</h5>
                        <h6 class="card-subtitle text-muted">{{__("Fill deal details below")}}</h6>
                    </div>
                    <div class="card-body">
                        {{ Form::model($deal, ['method' => 'PUT', 'route' => ['deals.update', $deal->id]]) }}

                        @include('sales-management::deals.fields')

                        <div class="my-3">
                            <button type="submit" class="btn btn-success me-2"
                                    id="notyf-show">{{__("Update Deal")}}</button>
                             <a href="{{ route('deals.index') }}" class="btn btn-info">{{__("Back")}}</a>
                         </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

