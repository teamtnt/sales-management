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

        <div class="row" style="flex-wrap: unset;" id="pipeline" data-pipeline-id="{{$campaign->pipeline_id}}">
            <div class="campaign-card">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __("Leads") }} ({{ $campaign->getLeadsOnStageCount($campaign->pipeline_id, 0) }})</h5>
                        <div class="input-group">
                             <span class="input-group-text">
                                 <x-sales-management::icons.search width="15" height="15"/>
                             </span>
                            <input id="lead-search-{{$campaign->pipeline_id}}" class="form-control lead-search"
                                   type="search" name="lead-search"
                                   data-stage-id="0"
                                   data-campaign-id="{{$campaign->id}}"
                                   data-pipeline-id="{{$campaign->pipeline_id}}"
                                   placeholder="Search leads by name or email...">
                        </div>
                    </div>
                    <div class="card-body scroll">
                        <div id="leads" data-stage-id="0">
                            @foreach($campaign->getLeadsOnStage($campaign->pipeline_id, 0, 50) as $lead)
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
                                           href="{{ route('teamtnt.sales-management.lists.create.from.stage', [$campaign->id, $stage->id]) }}">{{__("Create New List")}}</a>
                                    </div>
                                </div>
                            </div>
                            <h5 class="card-title">{{ $stage->name }} ({{ $campaign->getLeadsOnStageCount($campaign->pipeline_id, $stage->id) }})</h5>
                            <h6 class="card-subtitle text-muted mb-2">{{ $stage->description }}</h6>

                            <div class="input-group">
                             <span class="input-group-text">
                                 <x-sales-management::icons.search width="15" height="15"/>
                             </span>
                                <input id="lead-search-{{$campaign->pipeline_id}}" class="form-control lead-search"
                                       type="search" name="lead-search"
                                       data-stage-id="{{$stage->id}}"
                                       data-campaign-id="{{$campaign->id}}"
                                       data-pipeline-id="{{$campaign->pipeline_id}}"
                                       placeholder="Search leads by name or email...">
                            </div>
                        </div>
                        <div class="card-body scroll">

                            <div id="stage-{{$stage->id}}" data-stage-id="{{$stage->id}}">

                                @foreach($campaign->getLeadsOnStage($campaign->pipeline_id, $stage->id, 50) as $lead)
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
    <script defer type="module">
        document.addEventListener("DOMContentLoaded", function () {
            // Lead search
            const searchInputs = document.querySelectorAll('.lead-search');

            searchInputs.forEach(searchInput => {
                searchInput.addEventListener('input', function (e) {
                    const searchValue = this.value.toLowerCase();

                    const campaignID = this.dataset.campaignId;
                    const pipelineID = this.dataset.pipelineId;
                    const stageID = this.dataset.stageId;

                    axios.get(`/sales/campaign/${campaignID}/pipeline/${pipelineID}/stage/${stageID}/search`, {
                        params: {
                            query: searchValue
                        }
                    })
                        .then(response => {
                            // Get the stage id from the search input's data-stage-id attribute
                            const stageId = searchInput.dataset.stageId;

                            // Pass the stage id to updateUIWithSearchResults
                            updateUIWithSearchResults(response, stageId);
                        })
                        .catch(error => {
                            console.error(error);
                        });
                })
            })

            function updateUIWithSearchResults(response, stageId) {
                // Get the leads div for the correct stage
                const leadsDiv = document.querySelector(`div[data-stage-id="${stageId}"]`);

                // Remove the old stage from the Dragula containers
                const oldStageIndex = drake.containers.indexOf(leadsDiv);

                if (oldStageIndex > -1) {
                    drake.containers.splice(oldStageIndex, 1);
                }

                // Clear the current results
                leadsDiv.innerHTML = '';

                // Insert the returned HTML
                leadsDiv.innerHTML = response.data.html;

                // Add the updated stage to the Dragula containers
                drake.containers.push(leadsDiv);

            }

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
