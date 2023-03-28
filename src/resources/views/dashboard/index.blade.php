@extends('sales-management::layouts.app')

@section('title', 'Dashboard')


@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-auto d-none d-sm-block">

            <h1>Dashboard</h1>
            </div>
<div class="col-auto ms-auto text-end mt-n1">

							<div class="dropdown me-2 d-inline-block position-relative">
								<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar align-middle mt-n1"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> Today
      </a>

								<div class="dropdown-menu dropdown-menu-end">
									<h6 class="dropdown-header">Settings</h6>
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Another action</a>
									<a class="dropdown-item" href="#">Something else here</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#">Separated link</a>
								</div>
							</div>

							<button class="btn btn-primary shadow-sm">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter align-middle"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
    </button>
							<button class="btn btn-primary shadow-sm">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-cw align-middle"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
    </button>
						</div>
        </div>
    <div class="row">
        <x-sales-management::total-contacts/>
        <x-sales-management::deliveries/>
        <x-sales-management::opens/>
        <x-sales-management::clicks/>
        <x-sales-management::bounces/>
        <x-sales-management::spam-complaints/>
    </div>
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{__("Open / Clicks")}}</h5>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <open-clicks-chart :chart-data=@json($chartData) chart-type="bar"></open-clicks-chart>
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
                                @elseif($event->event_type === 'Sent')
                                    <strong>Message sent:</strong> [{{ $event->message_id }}
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
                    <!--
                    <div class="d-grid">
                        <a href="#" class="btn btn-primary">Load more</a>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
