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
                <a href="{{ route('messages.create', $campaign->id) }}" class="btn btn-warning mb-3">
                <span class="d-flex align-items-center">
                    <x-sales-management::icons.mail class="me-1"/> {{ __("Send email to leads") }}
                </span>
                </a>
            @endcan
            @can(config('sales-management.permission_prefix').'.view-workflows')
                <a href="{{ route('workflows.index', $campaign->id) }}" class="btn btn-info mb-3">
                 <span class="d-flex align-items-center">
                    <x-sales-management::icons.workflow class="me-1"/> {{ __("Workflows") }}
                </span>
                </a>
            @endcan
            @can(config('sales-management.permission_prefix').'.view-messages')
                <a href="{{ route('messages.index', $campaign->id) }}" class="btn btn-info mb-3">
                 <span class="d-flex align-items-center">
                    <x-sales-management::icons.mail class="me-1"/> {{ __("Messages") }}
                </span>
                </a>
            @endcan
        </div>


        <div class="row" style="flex-wrap: unset;" id="pipeline" data-pipeline-id="{{$campaign->pipeline_id}}">
            <div class="campaign-card">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __("Leads") }}</h5>
                        <div class="input-group">
                             <span class="input-group-text">
                                 <x-sales-management::icons.search width="15" height="15"/>
                             </span>
                            <input id="lead-search" class="form-control" type="search" name="lead-search"
                                   placeholder="Search leads by email...">
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="leads" data-stage-id="0">
                            @foreach($campaign->getLeadsOnStage($campaign->pipeline_id, 0, 100) as $lead)
                                <x-sales-management::lead-card :lead="$lead" off-canvas :campaign="$campaign"/>
                            @endforeach

                            <div class="card mb-3 px-2 py-4 cursor-grab border-dashed align-items-center">
                                <span style="font-size: 10px;"><i>Drag / drop area</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($campaign->pipeline->stages as $stage)
                <div class="campaign-card">
                    <div class="card" style="border-top: 8px solid {{ $stage->color }}">
                        <div class="card-header">
                            <div class="card-actions float-end">
                                <div class="dropdown position-relative">
                                    <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="feather feather-more-horizontal align-middle">
                                            <circle cx="12" cy="12" r="1"></circle>
                                            <circle cx="19" cy="12" r="1"></circle>
                                            <circle cx="5" cy="12" r="1"></circle>
                                        </svg>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item"
                                           href="{{ route('lists.create.from.stage', [$campaign->id, $stage->id]) }}">{{__("Create New List")}}</a>
                                    </div>
                                </div>
                            </div>
                            <h5 class="card-title">{{ $stage->name }}</h5>
                            <h6 class="card-subtitle text-muted">{{ $stage->description }}</h6>
                        </div>
                        <div class="card-body">

                            <div id="stage-{{$stage->id}}" data-stage-id="{{$stage->id}}">

                                @foreach($campaign->getLeadsOnStage($campaign->pipeline_id, $stage->id, 100) as $lead)
                                    <x-sales-management::lead-card :lead="$lead" off-canvas :campaign="$campaign"/>
                                @endforeach

                                <div class="card mb-3 px-2 py-4 cursor-grab border-dashed align-items-center">
                                    <span style="font-size: 10px;"><i>Drag / drop area</i></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop

@push('scripts')
    <script type="module">
        document.addEventListener("DOMContentLoaded", function () {
            // Lead search
            const searchInput = document.getElementById('lead-search');

            searchInput.addEventListener('input', function (e) {
                const searchValue = this.value.toLowerCase();
                const leads = document.querySelectorAll('#leads .lead-item');

                leads.forEach(lead => {
                    const email = lead.querySelector('.lead-email').textContent.toLowerCase();
                    if (email.includes(searchValue)) {
                        lead.style.display = '';
                    } else {
                        lead.style.display = 'none';
                    }
                })
            })


            const pipelineId = document.querySelector("#pipeline").dataset.pipelineId;

            let stages = [];
            stages.push(document.querySelector('#leads'));

            document.querySelectorAll("[id^='stage-']").forEach(function (element) {
                stages.push(element)
            })

            function handleMouseMove(e) {
                // horizontal scroll
                if (e.clientX > (window.innerWidth * 0.8)) {
                    document.querySelector('.content').scrollBy({
                        left: 12
                    });
                }

                // vertical scroll
                if (e.clientY > (window.innerHeight * 0.8)) {
                    document.querySelector('.content').scrollBy({
                        top: 12
                    });
                }

                // horizontal scroll to the left
                if (e.clientX < (window.innerWidth * 0.5)) {
                    document.querySelector('.content').scrollBy({
                        left: -12
                    });
                }

                // vertical scroll to the top
                if (e.clientY < (window.innerHeight * 0.3)) {
                    document.querySelector('.content').scrollBy({
                        top: -12
                    });
                }
            }


            dragula(stages)
                .on('drag', function (el) {
                    el.className = el.className.replace('bg-light', 'bg-gray-400');
                    document.addEventListener('mousemove', handleMouseMove, false);

                })
                .on('drop', function (el, target, source, sibling) {
                    el.className = el.className.replace('bg-gray-400', 'bg-light');

                    axios.post('{{ route('stage.change') }}', {
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
                })
        });
    </script>
@endpush
