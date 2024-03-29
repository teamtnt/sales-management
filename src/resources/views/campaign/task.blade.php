@extends('sales-management::layouts.app')

@section('content')

    <div class="container-fluid p-0">

        <a href="#" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New campaign</a>
        <h1 class="h3 mb-3">Campaigns</h1>

        <div class="row">
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-actions float-end">
                            <div class="dropdown position-relative">
                                <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
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
                        <h5 class="card-title">Upcoming</h5>
                        <h6 class="card-subtitle text-muted">Nam pretium turpis et arcu. Duis arcu.</h6>
                    </div>
                    <div class="card-body">

                        <div id="campaigns-upcoming">

                            <div class="card mb-3 bg-light cursor-grab border">
                                <div class="card-body p-3">
                                    <div class="float-end mr-n2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" aria-label="completed"
                                                   checked="">
                                        </label>
                                    </div>
                                    <p>Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo.
                                        Maecenas malesuada.</p>
                                    <div class="float-end mt-n1">
                                        <img src="https://appstack.bootlab.io/img/avatars/avatar.jpg" width="32"
                                             height="32" class="rounded-circle" alt="Avatar">
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="#">View</a>
                                </div>
                            </div>
                            <div class="card mb-3 bg-light cursor-grab border">
                                <div class="card-body p-3">
                                    <div class="float-end mr-n2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" aria-label="completed"
                                                   checked="">
                                        </label>
                                    </div>
                                    <p>Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec,
                                        imperdiet iaculis, ipsum.</p>
                                    <div class="float-end mt-n1">
                                        <img src="https://appstack.bootlab.io/img/avatars/avatar-2.jpg" width="32"
                                             height="32" class="rounded-circle" alt="Avatar">
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="#">View</a>
                                </div>
                            </div>
                            <div class="card mb-3 bg-light cursor-grab border">
                                <div class="card-body p-3">
                                    <div class="float-end mr-n2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" aria-label="completed">
                                        </label>
                                    </div>
                                    <p>Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu
                                        sollicitudin urna dolor sagittis.</p>
                                    <div class="float-end mt-n1">
                                        <img src="https://appstack.bootlab.io/img/avatars/avatar-3.jpg" width="32"
                                             height="32" class="rounded-circle" alt="Avatar">
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="#">View</a>
                                </div>
                            </div>
                            <div class="card mb-3 bg-light cursor-grab border">
                                <div class="card-body p-3">
                                    <div class="float-end mr-n2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" aria-label="completed">
                                        </label>
                                    </div>
                                    <p>In hac habitasse platea dictumst. Curabitur at lacus ac velit ornare lobortis.
                                        Curabitur a felis tristique.</p>
                                    <div class="float-end mt-n1">
                                        <img src="https://appstack.bootlab.io/img/avatars/avatar-4.jpg" width="32"
                                             height="32" class="rounded-circle" alt="Avatar">
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="#">View</a>
                                </div>
                            </div>
                            <div class="card mb-3 bg-light cursor-grab border">
                                <div class="card-body p-3">
                                    <div class="float-end mr-n2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" aria-label="completed">
                                        </label>
                                    </div>
                                    <p>Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec,
                                        imperdiet iaculis, ipsum.</p>
                                    <div class="float-end mt-n1">
                                        <img src="https://appstack.bootlab.io/img/avatars/avatar-2.jpg" width="32"
                                             height="32" class="rounded-circle" alt="Avatar">
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="#">View</a>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <a href="#" class="btn btn-primary">Add new campaign</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-actions float-end">
                            <div class="dropdown position-relative">
                                <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
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
                        <h5 class="card-title">In Progress</h5>
                        <h6 class="card-subtitle text-muted">Nam pretium turpis et arcu. Duis arcu.</h6>
                    </div>
                    <div class="card-body">

                        <div id="campaigns-progress">
                            <div class="card mb-3 bg-light cursor-grab border">
                                <div class="card-body p-3">
                                    <div class="float-end mr-n2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" aria-label="completed">
                                        </label>
                                    </div>
                                    <p>Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo.
                                        Maecenas malesuada.</p>
                                    <div class="float-end mt-n1">
                                        <img src="https://appstack.bootlab.io/img/avatars/avatar.jpg" width="32"
                                             height="32" class="rounded-circle" alt="Avatar">
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="#">View</a>
                                </div>
                            </div>
                            <div class="card mb-3 bg-light cursor-grab border">
                                <div class="card-body p-3">
                                    <div class="float-end mr-n2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" aria-label="completed">
                                        </label>
                                    </div>
                                    <p>Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu
                                        sollicitudin urna dolor sagittis.</p>
                                    <div class="float-end mt-n1">
                                        <img src="https://appstack.bootlab.io/img/avatars/avatar-3.jpg" width="32"
                                             height="32" class="rounded-circle" alt="Avatar">
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="#">View</a>
                                </div>
                            </div>
                            <div class="card mb-3 bg-light cursor-grab border">
                                <div class="card-body p-3">
                                    <div class="float-end mr-n2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" aria-label="completed">
                                        </label>
                                    </div>
                                    <p>Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec,
                                        imperdiet iaculis, ipsum.</p>
                                    <div class="float-end mt-n1">
                                        <img src="https://appstack.bootlab.io/img/avatars/avatar-2.jpg" width="32"
                                             height="32" class="rounded-circle" alt="Avatar">
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="#">View</a>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <a href="#" class="btn btn-primary">Add new campaign</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-actions float-end">
                            <div class="dropdown position-relative">
                                <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
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
                        <h5 class="card-title">Completed</h5>
                        <h6 class="card-subtitle text-muted">Nam pretium turpis et arcu. Duis arcu.</h6>
                    </div>
                    <div class="card-body">

                        <div id="campaigns-completed">
                            <div class="card mb-3 bg-light cursor-grab border">
                                <div class="card-body p-3">
                                    <div class="float-end mr-n2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" aria-label="completed">
                                        </label>
                                    </div>
                                    <p>Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec,
                                        imperdiet iaculis, ipsum.</p>
                                    <div class="float-end mt-n1">
                                        <img src="https://appstack.bootlab.io/img/avatars/avatar-2.jpg" width="32"
                                             height="32" class="rounded-circle" alt="Avatar">
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="#">View</a>
                                </div>
                            </div>
                            <div class="card mb-3 bg-light cursor-grab border">
                                <div class="card-body p-3">
                                    <div class="float-end mr-n2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" aria-label="completed">
                                        </label>
                                    </div>
                                    <p>In hac habitasse platea dictumst. Curabitur at lacus ac velit ornare lobortis.
                                        Curabitur a felis tristique.</p>
                                    <div class="float-end mt-n1">
                                        <img src="https://appstack.bootlab.io/img/avatars/avatar-4.jpg" width="32"
                                             height="32" class="rounded-circle" alt="Avatar">
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="#">View</a>
                                </div>
                            </div>
                            <div class="card mb-3 bg-light cursor-grab border">
                                <div class="card-body p-3">
                                    <div class="float-end mr-n2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" aria-label="completed">
                                        </label>
                                    </div>
                                    <p>Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu
                                        sollicitudin urna dolor sagittis.</p>
                                    <div class="float-end mt-n1">
                                        <img src="https://appstack.bootlab.io/img/avatars/avatar-3.jpg" width="32"
                                             height="32" class="rounded-circle" alt="Avatar">
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="#">View</a>
                                </div>
                            </div>
                            <div class="card mb-3 bg-light cursor-grab border">
                                <div class="card-body p-3">
                                    <div class="float-end mr-n2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" aria-label="completed">
                                        </label>
                                    </div>
                                    <p>Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo.
                                        Maecenas malesuada.</p>
                                    <div class="float-end mt-n1">
                                        <img src="https://appstack.bootlab.io/img/avatars/avatar.jpg" width="32"
                                             height="32" class="rounded-circle" alt="Avatar">
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="#">View</a>
                                </div>
                            </div>
                            <div class="card mb-3 bg-light cursor-grab border">
                                <div class="card-body p-3">
                                    <div class="float-end mr-n2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" aria-label="completed">
                                        </label>
                                    </div>
                                    <p>Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu
                                        sollicitudin urna dolor sagittis.</p>
                                    <div class="float-end mt-n1">
                                        <img src="https://appstack.bootlab.io/img/avatars/avatar-3.jpg" width="32"
                                             height="32" class="rounded-circle" alt="Avatar">
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="#">View</a>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <a href="#" class="btn btn-primary">Add new campaign</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-actions float-end">
                            <div class="dropdown position-relative">
                                <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
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
                        <h5 class="card-title">Completed</h5>
                        <h6 class="card-subtitle text-muted">Nam pretium turpis et arcu. Duis arcu.</h6>
                    </div>
                    <div class="card-body">

                        <div id="campaigns-completed">
                            <div class="card mb-3 bg-light cursor-grab border">
                                <div class="card-body p-3">
                                    <div class="float-end mr-n2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" aria-label="completed">
                                        </label>
                                    </div>
                                    <p>Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec,
                                        imperdiet iaculis, ipsum.</p>
                                    <div class="float-end mt-n1">
                                        <img src="https://appstack.bootlab.io/img/avatars/avatar-2.jpg" width="32"
                                             height="32" class="rounded-circle" alt="Avatar">
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="#">View</a>
                                </div>
                            </div>
                            <div class="card mb-3 bg-light cursor-grab border">
                                <div class="card-body p-3">
                                    <div class="float-end mr-n2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" aria-label="completed">
                                        </label>
                                    </div>
                                    <p>In hac habitasse platea dictumst. Curabitur at lacus ac velit ornare lobortis.
                                        Curabitur a felis tristique.</p>
                                    <div class="float-end mt-n1">
                                        <img src="https://appstack.bootlab.io/img/avatars/avatar-4.jpg" width="32"
                                             height="32" class="rounded-circle" alt="Avatar">
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="#">View</a>
                                </div>
                            </div>
                            <div class="card mb-3 bg-light cursor-grab border">
                                <div class="card-body p-3">
                                    <div class="float-end mr-n2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" aria-label="completed">
                                        </label>
                                    </div>
                                    <p>Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu
                                        sollicitudin urna dolor sagittis.</p>
                                    <div class="float-end mt-n1">
                                        <img src="https://appstack.bootlab.io/img/avatars/avatar-3.jpg" width="32"
                                             height="32" class="rounded-circle" alt="Avatar">
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="#">View</a>
                                </div>
                            </div>
                            <div class="card mb-3 bg-light cursor-grab border">
                                <div class="card-body p-3">
                                    <div class="float-end mr-n2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" aria-label="completed">
                                        </label>
                                    </div>
                                    <p>Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo.
                                        Maecenas malesuada.</p>
                                    <div class="float-end mt-n1">
                                        <img src="https://appstack.bootlab.io/img/avatars/avatar.jpg" width="32"
                                             height="32" class="rounded-circle" alt="Avatar">
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="#">View</a>
                                </div>
                            </div>
                            <div class="card mb-3 bg-light cursor-grab border">
                                <div class="card-body p-3">
                                    <div class="float-end mr-n2">
                                        <label class="form-check">
                                            <input type="checkbox" class="form-check-input" aria-label="completed">
                                        </label>
                                    </div>
                                    <p>Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu
                                        sollicitudin urna dolor sagittis.</p>
                                    <div class="float-end mt-n1">
                                        <img src="https://appstack.bootlab.io/img/avatars/avatar-3.jpg" width="32"
                                             height="32" class="rounded-circle" alt="Avatar">
                                    </div>
                                    <a class="btn btn-primary btn-sm" href="#">View</a>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <a href="#" class="btn btn-primary">Add new campaign</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
