@extends('sales-management::layouts.app')

@section('title', 'Tags')
@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
    <li class="breadcrumb-item">{{ __('Tags') }}</li>
    <li class="breadcrumb-item active">{{ __('Edit Tag') }}</li>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ __('Edit Contact') }}</h1>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{__("Tag form")}}</h5>
                        <h6 class="card-subtitle text-muted">{{__("Fill tag details below")}}</h6>
                    </div>
                    <div class="card-body">
                        {{ Form::model($tag, ['method' => 'PUT', 'route' => ['tags.update', $tag->id]]) }}

                        @include('sales-management::tags.fields')

                        <div class="my-3">
                            <button type="submit" class="btn btn-success me-2"
                                    id="notyf-show">{{__("Update Tag")}}</button>
                             <a href="{{ route('teamtnt.sales-management.tags.index') }}" class="btn btn-info">{{__("Back")}}</a>
                         </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

