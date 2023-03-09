@extends('sales-management::layouts.app')

@section('title', 'Workflows')
@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
    <li class="breadcrumb-item">{{ __('Campaigns') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('campaign.show', $campaign->id) }}">{{ __($campaign->name) }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('workflows.edit', [$campaign->id, $workflow->id]) }}">{{ $workflow->name }}</a>
    </li>
    <li class="breadcrumb-item active">Debug State Machine</li>
@endsection
@section('content')
    <div class="container-fluid p-0">
        <a target="_blank" class="btn btn-danger mb-3"
           href="https://dreampuf.github.io/GraphvizOnline/#{{ $dumper->dump($workflow->getStateMachineDefinition()) }}">Visualize</a>
        <pre>
            {{ $dumper->dump($workflow->getStateMachineDefinition()) }}
        </pre>
    </div>
@endsection
