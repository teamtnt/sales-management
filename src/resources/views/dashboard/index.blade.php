@extends('sales-management::layouts.app')

@section('title', 'Dashboard')


@section('content')
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-12 col-sm-6 col-xxl-2 d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">{{ $contactsCount }}</h3>
                            <p class="mb-2">{{ __("Total Contacts") }}</p>
                            <div class="mb-0">
                                <span class="badge badge-soft-success me-2"> 23 </span>
                                <span class="text-muted">Since last week</span>
                            </div>
                        </div>
                        <div class="d-inline-block ms-3">
                            <div class="stat">
                                <i class="align-middle text-success" data-feather="user"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-2 d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">{{ $deliveries }}</h3>
                            <p class="mb-2">{{ __("Deliveries") }}</p>
                            <div class="mb-0">
                                <span class="badge badge-soft-success me-2"> 99% </span>
                                <span class="text-muted">{{ __("Delivery rate") }}</span>
                            </div>
                        </div>
                        <div class="d-inline-block ms-3">
                            <div class="stat">
                                <i class="align-middle text-success" data-feather="user"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-2 d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">{{ $opens }}</h3>
                            <p class="mb-2">{{ __("Opens") }}</p>
                            <div class="mb-0">
                                <span class="badge badge-soft-danger me-2"> 0,54 </span>
                                <span class="text-muted">Open rate</span>
                            </div>
                        </div>
                        <div class="d-inline-block ms-3">
                            <div class="stat">
                                <i class="align-middle" data-feather="home"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-2 d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">{{ $clicks }}</h3>
                            <p class="mb-2">{{ __("Clicks") }}</p>
                            <div class="mb-0">
                                <span class="badge badge-soft-success me-2">0.12</span>
                                <span class="text-muted">Click rate</span>
                            </div>
                        </div>
                        <div class="d-inline-block ms-3">
                            <div class="stat">
                                <i class="align-middle text-success" data-feather="check-square"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-2 d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">{{ $bounces }}</h3>
                            <p class="mb-2">{{ __("Bounces") }}</p>
                            <div class="mb-0">
                                <span class="badge badge-soft-success me-2">0.03</span>
                                <span class="text-muted">{{ __("Bounce rate") }}</span>
                            </div>
                        </div>
                        <div class="d-inline-block ms-3">
                            <div class="stat">
                                <i class="align-middle text-success" data-feather="check-square"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-2 d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">{{ $spamComplaints }}</h3>
                            <p class="mb-2">{{ __("Spam Complains") }}</p>
                            <div class="mb-0">
                                <span class="badge badge-soft-success me-2">0.3</span>
                                <span class="text-muted">{{ __("Spam complaint rate")}}</span>
                            </div>
                        </div>
                        <div class="d-inline-block ms-3">
                            <div class="stat">
                                <i class="align-middle text-success" data-feather="check-square"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-8 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <div class="card-actions float-end">
                        <div class="dropdown position-relative">
                            <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
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
                    <h5 class="card-title mb-0">Sales / Revenue</h5>
                </div>
                <div class="card-body d-flex w-100">
                    <div class="align-self-center chart chart-lg">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="chartjs-dashboard-bar" style="display: block; height: 350px; width: 749px;" width="1498" height="700" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{__("Feed")}}</h5>
                </div>
                <div class="card-body">
                    @foreach($events as $event)
                    <div class="d-flex align-items-start">
                        <i class="align-middle text-success" data-feather="user"></i>
                        <div class="flex-grow-1">
                            <small class="float-end">{{$event->created_at->diffForHumans()}}</small>
                            @if($event->event_type === 'Open')
                               Email opened: {{ $event->message_id }} ({{ $event->recipient }})
                            @elseif($event->event_type === 'Click')
                               Email clicked: {{ $event->message_id }} ({{ $event->recipient }})
                            @elseif($event->event_type === 'SpamComplaint')
                               Spam complaint: {{ $event->message_id }} ({{ $event->recipient }})
                            @elseif($event->event_type === 'Bounce')
                               Email bounced: {{ $event->message_id }} ({{ $event->recipient }})
                            @elseif($event->event_type === 'Delivery')
                               Email delivered: {{ $event->message_id }} ({{ $event->recipient }})
                            @elseif($event->event_type === 'SubscriptionChange')
                               Subscription change: {{ $event->message_id }} ({{ $event->recipient }})
                            @endif
                            <br>
                            <small class="text-muted">{{ $event->created_at->isToday() ? 'Today ' : $event->created_at->format('d.m.Y') }} {{ $event->created_at->format('g:i A') }}</small><br>

                        </div>
                    </div>
                    <hr>
                    @endforeach
                    <div class="d-grid">
                        <a href="#" class="btn btn-primary">Load more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

