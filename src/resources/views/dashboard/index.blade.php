@extends('sales-management::layouts.app')

@section('title', 'Dashboard')


@section('content')
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card illustration flex-fill">
                <div class="card-body p-0 d-flex flex-fill">
                    <div class="row g-0 w-100">
                        <div class="col-6">
                            <div class="illustration-text p-3 m-1">
                                <h4 class="illustration-text">Welcome Back, Chris!</h4>
                                <p class="mb-0">AppStack Dashboard</p>
                            </div>
                        </div>
                        <div class="col-6 align-self-end text-end">
                            <img src="/sales-management/img/illustrations/customer-support.png" alt="Customer Support" class="img-fluid illustration-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">$ 24.300</h3>
                            <p class="mb-2">{{ __("Total Contacts") }}</p>
                            <div class="mb-0">
                                <span class="badge badge-soft-success me-2"> +5.35% </span>
                                <span class="text-muted">Since last week</span>
                            </div>
                        </div>
                        <div class="d-inline-block ms-3">
                            <div class="stat">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign align-middle text-success"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">43</h3>
                            <p class="mb-2">{{ __("Total Companies") }}</p>
                            <div class="mb-0">
                                <span class="badge badge-soft-danger me-2"> -4.25% </span>
                                <span class="text-muted">Since last week</span>
                            </div>
                        </div>
                        <div class="d-inline-block ms-3">
                            <div class="stat">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag align-middle text-danger"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xxl-3 d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h3 class="mb-2">$ 18.700</h3>
                            <p class="mb-2">{{ __("Deals Closed") }}</p>
                            <div class="mb-0">
                                <span class="badge badge-soft-success me-2"> +8.65% </span>
                                <span class="text-muted">Since last week</span>
                            </div>
                        </div>
                        <div class="d-inline-block ms-3">
                            <div class="stat">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign align-middle text-info"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
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
                    <div class="align-self-center chart chart-lg"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="chartjs-dashboard-bar" style="display: block; height: 350px; width: 749px;" width="1498" height="700" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 d-flex">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <span class="badge bg-info float-end">Today</span>
                    <h5 class="card-title mb-0">Daily feed</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <img src="/sales-management/img/avatars/avatar-5.jpg" width="36" height="36" class="rounded-circle me-2" alt="Ashley Briggs">
                        <div class="flex-grow-1">
                            <small class="float-end">5m ago</small>
                            <strong>Ashley Briggs</strong> started following <strong>Stacie Hall</strong><br>
                            <small class="text-muted">Today 7:51 pm</small><br>

                        </div>
                    </div>

                    <hr>
                    <div class="d-flex align-items-start">
                        <img src="/sales-management/img/avatars/avatar.jpg" width="36" height="36" class="rounded-circle me-2" alt="Chris Wood">
                        <div class="flex-grow-1">
                            <small class="float-end">30m ago</small>
                            <strong>Chris Wood</strong> posted something on <strong>Stacie Hall</strong>'s timeline<br>
                            <small class="text-muted">Today 7:21 pm</small>

                            <div class="border text-sm text-muted p-2 mt-1">
                                Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing...
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex align-items-start">
                        <img src="/sales-management/img/avatars/avatar-4.jpg" width="36" height="36" class="rounded-circle me-2" alt="Stacie Hall">
                        <div class="flex-grow-1">
                            <small class="float-end">1h ago</small>
                            <strong>Stacie Hall</strong> posted a new blog<br>

                            <small class="text-muted">Today 6:35 pm</small>
                        </div>
                    </div>

                    <hr>
                    <div class="d-grid">
                        <a href="#" class="btn btn-primary">Load more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

