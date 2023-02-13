@extends('sales-management::layouts.app')

@section('content')

    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">{{ $task->name }}</h1>
        <h6 class="mb-3">{{ $task->description }}</h6>

        <div class="row" id="pipeline" data-pipeline-id="{{$task->pipeline_id}}">
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ __("Leads") }}</h5>
                    </div>
                    <div class="card-body">

                        <div id="leads">
                            @foreach($task->getLeadsOnStage($task->pipeline_id, 0, 100) as $lead)
                                <x-sales-management::lead-card :lead="$lead"/>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @foreach($task->pipeline->stages as $stage)
                <div class="col-12 col-lg-6 col-xl-3">
                    <div class="card">
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
                                           href="{{ route('lists.create.from.stage', [$task->id, $stage->id]) }}">{{__("Create New List")}}</a>
                                    </div>
                                </div>
                            </div>
                            <h5 class="card-title">{{ $stage->name }}</h5>
                            <h6 class="card-subtitle text-muted">{{ $stage->description }}</h6>
                        </div>
                        <div class="card-body">

                            <div id="stage-{{$stage->id}}" data-stage-id="{{$stage->id}}">

                                @foreach($task->getLeadsOnStage($task->pipeline_id, $stage->id, 100) as $lead)
                                    <x-sales-management::lead-card :lead="$lead"/>
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
            const pipelineId = document.querySelector("#pipeline").dataset.pipelineId;

            let stages = [];
            stages.push(document.querySelector('#leads'));

            document.querySelectorAll("[id^='stage-']").forEach(function (element) {
                stages.push(element)
            })

            dragula(stages)
                .on('drag', function (el) {
                    el.className = el.className.replace('bg-light', 'bg-gray-400');
                })
                .on('drop', function (el, target, source, sibling) {
                    el.className = el.className.replace('bg-gray-400', 'bg-light');

                    axios.post('{{ route('stage.change') }}', {
                        lead_id: el.dataset.leadId,
                        pipeline_id: pipelineId,
                        source_stage_id: source.dataset.stageId,
                        target_stage_id: target.dataset.stageId
                    })
                })
                .on('over', function (el, container) {
                    el.className = el.className.replace('bg-gray-400', 'bg-light');
                })
        });
    </script>

@endpush
