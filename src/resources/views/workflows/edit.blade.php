@extends('sales-management::layouts.app')

@section('title', 'Workflows')

@section('add-css-class', 'overflow-hidden px-0 py-0')

@section('content')
    <work-flow
            save-url="{{ route('workflows.update', [$task->id, $workflow->id]) }}"
            back-url="{{ route('workflows.index', [$task->id]) }}"
            workflow-title="{{ $workflow->name }}"
            panel-title="{{ $workflow->name }}"
            :elements-data="{{ $workflow->elements ?? json_encode([]) }}"
            :messages="{{ json_encode($messages) }}"
            :messages-opened="{{ json_encode($messagesOpened) }}"
            :contact-lists="{{ json_encode($contactLists) }}"
            :wait-options="{{ json_encode($waitOptions) }}"
    ></work-flow>
@endsection

