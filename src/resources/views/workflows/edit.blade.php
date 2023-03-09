@extends('sales-management::layouts.app')

@section('title', 'Workflows')

@section('add-css-class', 'overflow-hidden px-0 py-0')

@section('content')
    <work-flow
            save-url="{{ route('workflows.update', [$campaign->id, $workflow->id]) }}"
            back-url="{{ route('workflows.index', [$campaign->id]) }}"
            workflow-name="{{ $workflow->name }}"
            :workflow-id="{{ $workflow->id }}"
            :elements-data="{{ $workflow->elements ?? json_encode([]) }}"
            :messages="{{ json_encode($messages) }}"
            :messages-opened="{{ json_encode($messagesOpened) }}"
            :contact-lists="{{ json_encode($contactLists) }}"
            :wait-options="{{ json_encode($waitOptions) }}"
            :ab-split="{{ json_encode($abSplit) }}"
            :stages="{{ json_encode($stages) }}"
            :tags="{{ json_encode($tags) }}"
    ></work-flow>
@endsection

