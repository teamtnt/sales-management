@extends('sales-management::layouts.app')

@section('title', 'Workflows')

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{ __('Edit Workflow ') }}</h1>
        <div class="row">
            <div class="col-12 col-md-10 ">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{__("Workflow form")}}</h5>
                        <h6 class="card-subtitle text-muted">{{__("Fill workflow details below")}}</h6>
                    </div>
                    <div class="card-body">
                        {{ Form::model($workflow, ['method' => 'PUT', 'route' => ['workflows.update', $workflow->id]]) }}

                        @include('sales-management::workflows.fields')

                        <div class="my-3">
                            <button type="submit" class="btn btn-success me-2"
                                    id="notyf-show">{{__("Update Workflow")}}</button>
                            <a href="{{ route('workflows.index') }}" class="btn btn-info">{{__("Back")}}</a>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

