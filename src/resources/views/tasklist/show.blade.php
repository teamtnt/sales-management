@extends('sales-management::layouts.app')

@section('content')

    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">{{ $task->name }}</h1>
        <h6 class="mb-3">{{ $task->description }}</h6>

        <div class="row">
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Leads</h5>
                    </div>
                    <div class="card-body">

                        <div id="leads">
                            @foreach($task->getLeads() as $lead)
                                <div class="card mb-3 p-2 bg-light cursor-grab border">
                                    {{ $lead->email }} <br>
                                    {{ $lead->phone }}
                                </div>
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
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <h5 class="card-title">{{ $stage->name }}</h5>
                            <h6 class="card-subtitle text-muted">{{ $stage->description }}</h6>
                        </div>
                        <div class="card-body">

                            <div id="stage-{{$stage->id}}">

                                @foreach(range(1, 100) as $contact)
                                    <div class="card mb-3 p-2 bg-light cursor-grab border">
                                        ime.prezine@mail.com <br>
                                        098 1234 567
                                    </div>
                                @endforeach
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
            let stages = [];
            stages.push(document.querySelector('#leads'));

            document.querySelectorAll("[id^='stage-']").forEach(function (element) {
                stages.push(element)
            })

            dragula(stages).on('drag', function (el) {
                //console.log("sada je drag", el)
            }).on('drop', function (el, target, source, sibling) {
                console.log("sada je drop", el, target, source, sibling)
            }).on('over', function (el, container) {
                //console.log("sada je over", el, container)
            }).on('out', function (el, container) {
                //console.log("sada je out", el, container)
            });
        });
    </script>

@endpush
