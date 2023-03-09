@extends('sales-management::layouts.app')

@section('title', 'Workflows')

@section('add-css-class', 'overflow-hidden px-0 py-0')

@section('content')
    <work-flow
        save-url="{{ route('workflows.store', [$campaign->id])}}"
        back-url="{{ route('workflows.index', [$campaign->id]) }}"
        workflow-name="Untitled Workflow"
        :messages="{{ json_encode($messages) }}"
        :messages-opened="{{ json_encode($messagesOpened) }}"
        :contact-lists="{{ json_encode($contactLists) }}"
        :wait-options="{{ json_encode($waitOptions) }}"
        :ab-split="{{ json_encode($abSplit) }}"
        :stages="{{ json_encode($stages) }}"
        :tags="{{ json_encode($tags) }}"
    ></work-flow>
@stop

