@extends('sales-management::layouts.app')

@section('content')

    <div class="container-fluid p-0">

        <a href="{{ route('campaign.create') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i>
            New
            campaign</a>
        <h1 class="h3 mb-3">Campaigns</h1>

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
