@extends('sales-management::layouts.app')

@section('title', $campaign->name)

@section('add-css-class', 'overflow-auto')
@push('styles')
    <style>
        body {
            overflow: hidden !important;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid p-0" style="height: 75vh;">
        <h1 class="h3 mb-3">{{ $campaign->name }}</h1>
        <h6 class="mb-3">{{ $campaign->description }}</h6>
        <div class="d-flex gap-2">
            @can(config('sales-management.permission_prefix').'.send-emails')
                <a href="{{ route('teamtnt.sales-management.messages.create', $campaign->id) }}" class="btn btn-warning mb-3">
                <span class="d-flex align-items-center">
                    <x-sales-management::icons.mail class="me-1"/> {{ __("Send email to leads") }}
                </span>
                </a>
            @endcan
            @can(config('sales-management.permission_prefix').'.view-workflows')
                <a href="{{ route('teamtnt.sales-management.workflows.index', $campaign->id) }}" class="btn btn-info mb-3">
                 <span class="d-flex align-items-center">
                    <x-sales-management::icons.workflow class="me-1"/> {{ __("Workflows") }}
                </span>
                </a>
            @endcan
            @can(config('sales-management.permission_prefix').'.view-messages')
                <a href="{{ route('teamtnt.sales-management.messages.index', $campaign->id) }}" class="btn btn-info mb-3">
                 <span class="d-flex align-items-center">
                    <x-sales-management::icons.mail class="me-1"/> {{ __("Messages") }}
                </span>
                </a>
            @endcan
        </div>
        <lead-campaign
            :campaign="{{ $campaign }}"
            :initial-leads="{{ json_encode($initialLeads) }}"
            :initial-leads-count="{{ $initialLeadsCount }}"
            :leads-count="{{ json_encode($leadsCount) }}"
            :leads="{{ json_encode($leads) }}"
            :stages="{{ $stages }}"
            :emails="{{ json_encode(config('sales-management.emails')) }}"
            :routes="{{ json_encode($routes) }}"
            initial-search="{{ $globalSearch }}"
        />
    </div>
@stop

@push('scripts')
    <script defer type="module">
        document.addEventListener("DOMContentLoaded", function () {

            const pipelineId = document.querySelector("#pipeline").dataset.pipelineId;

            let stages = [];
            stages.push(document.querySelector('#leads'));

            document.querySelectorAll("[id^='stage-']").forEach(function (element) {
                stages.push(element)
            })
            const windowInnerWidth = window.innerWidth;
            const windowInnerHeight = window.innerHeight;

            function handleMouseMove(e) {
                // horizontal scroll
                if (e.clientX > (windowInnerWidth * 0.8)) {
                    document.querySelector('.content').scrollBy({
                        left: 12
                    });
                }

                // vertical scroll
                if (e.clientY > (windowInnerHeight * 0.8)) {
                    document.querySelector('.content').scrollBy({
                        top: 12
                    });
                }

                // horizontal scroll to the left
                if (e.clientX < (windowInnerWidth * 0.5)) {
                    document.querySelector('.content').scrollBy({
                        left: -12
                    });
                }

                // vertical scroll to the top
                if (e.clientY < (windowInnerHeight * 0.3)) {
                    document.querySelector('.content').scrollBy({
                        top: -12
                    });
                }
            }


            let drake = dragula({
                moves: function (el, source, handle, sibling) {
                     return handle.classList.contains('drag-handle');
                },
            }).on('drag', function (el) {
                    el.className = el.className.replace('bg-light', 'bg-gray-400');
                    document.addEventListener('mousemove', handleMouseMove, false);

                })
                .on('drop', function (el, target, source, sibling) {
                    el.className = el.className.replace('bg-gray-400', 'bg-light');

                    axios.post('{{ route('teamtnt.sales-management.stage.change') }}', {
                        lead_id: el.dataset.leadId,
                        pipeline_id: pipelineId,
                        source_stage_id: source.dataset.stageId,
                        target_stage_id: target.dataset.stageId
                    })

                    document.removeEventListener('mousemove', handleMouseMove, false);
                })
                .on('over', function (el, container) {
                    el.className = el.className.replace('bg-gray-400', 'bg-light');

                })
                .on('cancel', function (el, container, source) {
                    el.className = el.className.replace('bg-gray-400', 'bg-light');

                    document.removeEventListener('mousemove', handleMouseMove, false);
                });

            drake.containers.push(...stages);
        });
    </script>
@endpush
