@extends('sales-management::layouts.app')

@section('title', 'Dashboard')


@section('content')
    <h1>Dashboard</h1>
    <div class="row">
        <x-sales-management::total-contacts/>
        <x-sales-management::deliveries/>
        <x-sales-management::opens/>
        <x-sales-management::clicks/>
        <x-sales-management::bounces/>
        <x-sales-management::spam-complaints/>
    </div>
    <div class="row">
        <div class="col-12 col-lg-8 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{__("Open / Clicks")}}</h5>
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
                        <canvas id="chartjs-dashboard-bar" style="display: block; height: 350px; width: 749px;"
                                width="1498" height="700" class="chartjs-render-monitor"></canvas>
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
                            <div class="flex-grow-1">
                                @if($event->event_type === 'Open')
                                    <strong>Email opened:</strong> [{{ $event->message_id }}
                                    ] {{ $event->message->subject }} <br>
                                    {{ $event->recipient }}
                                @elseif($event->event_type === 'Click')
                                    <strong>{{__("Email Link Clicked")}}:</strong> <a
                                        href="{{ $event->getPayload('OriginalLink') }}"
                                        target="_blank">{{ $event->getPayload('OriginalLink') }}</a>
                                    {{ $event->recipient }}
                                @elseif($event->event_type === 'SpamComplaint')
                                    <strong>Spam complaint:</strong> [{{ $event->message_id }}
                                    ] {{ $event->message->subject }} <br>
                                    {{ $event->recipient }}
                                @elseif($event->event_type === 'Bounce')
                                    <strong>Email bounced:</strong> [{{ $event->message_id }}
                                    ] {{ $event->message->subject }} <br>
                                    {{ $event->recipient }}
                                @elseif($event->event_type === 'Delivery')
                                    <strong>Email delivered:</strong> [{{ $event->message_id }}
                                    ] {{ $event->message->subject }} <br>
                                    {{ $event->recipient }}
                                @elseif($event->event_type === 'SubscriptionChange')
                                    <strong>Subscription change:</strong> [{{ $event->message_id }}
                                    ] {{ $event->message->subject }} <br>
                                    {{ $event->recipient }}
                                @endif
                                <br>
                                <small
                                    class="text-muted">{{ $event->created_at->isToday() ? 'Today ' : $event->created_at->format('d.m.Y') }} {{ $event->created_at->format('g:i A') }}</small><br>

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

