@props(['lead' => $lead, 'offCanvas' => false])

<div class="lead-item card mb-3 p-2 bg-light border gap-1" data-lead-id="{{ $lead->id }}">
    <div class="d-flex align-items-center">
        <x-sales-management::icons.user/>
        <span class="ms-2">{{ $lead->contact->firstname }} {{ $lead->contact->lastname }}</span>
    </div>
    <div class="d-flex align-items-center">
        <x-sales-management::icons.mail />
        <span class="ms-2 lead-email">{{ $lead->contact->email }}</span>
    </div>
    <div class="d-flex align-items-center">
        <x-sales-management::icons.phone />
        <span class="ms-2">  {{ $lead->contact->phone }}</span>
    </div>
    @if($offCanvas)
        <span class="info-icon" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight-{{ $lead->contact->id }}" aria-controls="offcanvasRight">
            <x-sales-management::icons.info />
        </span>
    @endif
</div>

@if($offCanvas)
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight-{{ $lead->contact->id }}" aria-labelledby="offcanvasRightLabel-{{$lead->contact->id}}">
        <div class="offcanvas-header bg-light">
            <h4 class="offcanvas-title" id="offcanvasRightLabel-{{$lead->contact->id}}">
                <span class="d-flex">
                    <x-sales-management::icons.user class="me-2" style="width: 24px; height: 24px;"/> {{ __('User') }}: {{ $lead->contact->fullname }}
                </span>
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <dl class="row mb-3">
                <dt class="col-4 col-xxl-3 mb-0">
                    <strong>{{ __('User ID') }}:</strong>
                </dt>
                <dd class="col-8 col-xxl-9 mb-0">
                    <p class="mb-1">{{ $lead->contact->id }}</p>
                </dd>
                <dt class="col-4 col-xxl-3 mb-0">
                    <strong>{{ __('Firstname') }}:</strong>
                </dt>
                <dd class="col-8 col-xxl-9 mb-0">
                    <p class="mb-1">{{ $lead->contact->firstname }}</p>
                </dd>

                <dt class="col-4 col-xxl-3 mb-0"><strong>{{ __('Lastname')  }}:</strong></dt>
                <dd class="col-8 col-xxl-9 mb-0">
                    <p class="mb-1">{{ $lead->contact->lastname }}</p>
                </dd>
                <dt class="col-4 col-xxl-3 mb-0">
                    <strong>{{ __('Job title') }}:</strong>
                </dt>
                <dd class="col-8 col-xxl-9 mb-0">
                    <p class="mb-1">{{ $lead->contact->job_title }}</p>
                </dd>
                <dt class="col-4 col-xxl-3 mb-0">
                    <strong>{{ __('Email') }}:</strong>
                </dt>
                <dd class="col-8 col-xxl-9 mb-0">
                    <p class="mb-1">{{ $lead->contact->email }}</p>
                </dd>
                <dt class="col-4 col-xxl-3 mb-0">
                    <strong>{{ __('Phone') }}:</strong>
                </dt>
                <dd class="col-8 col-xxl-9 mb-0">
                    <p class="mb-1">{{ $lead->contact->phone }}</p>
                </dd>
                <dt class="col-4 col-xxl-3 mb-0">
                    <strong>{{ __('Company') }}:</strong>
                </dt>
                <dd class="col-8 col-xxl-9 mb-0">
                    <p class="mb-1">{{ $lead->contact->company_name }}</p>
                </dd>
                <dt class="col-4 col-xxl-3 mb-0">
                    <strong>{{ __('VAT') }}:</strong>
                </dt>
                <dd class="col-8 col-xxl-9 mb-0">
                    <p class="mb-1">{{ $lead->contact->vat }}</p>
                </dd>
                <dt class="col-4 col-xxl-3 mb-0">
                    <strong>{{ __('Contact') }}:</strong>
                </dt>
                <dd class="col-8 col-xxl-9 mb-0">
                    <p class="mb-1">{{ $lead->contact->company_email }}</p>
                </dd>
                <dt class="col-4 col-xxl-3 mb-0">
                    <strong>{{ __('Website') }}:</strong>
                </dt>
                <dd class="col-8 col-xxl-9 mb-0">
                    <p class="mb-1">{{ $lead->contact->url }}</p>
                </dd>
                <dt class="col-4 col-xxl-3 mb-0">
                    <strong>{{ __('Address') }}:</strong>
                </dt>
                <dd class="col-8 col-xxl-9 mb-0">
                    <p class="mb-1">{{ $lead->contact->address }}</p>
                </dd>
                <dt class="col-4 col-xxl-3 mb-0">
                    <strong>{{ __('ZIP') }}:</strong>
                </dt>
                <dd class="col-8 col-xxl-9 mb-0">
                    <p class="mb-1">{{ $lead->contact->postal }}</p>
                </dd>
                <dt class="col-4 col-xxl-3 mb-0">
                    <strong>{{ __('City') }}:</strong>
                </dt>
                <dd class="col-8 col-xxl-9 mb-0">
                    <p class="mb-1">{{ $lead->contact->city }}</p>
                </dd>
                <dt class="col-4 col-xxl-3 mb-0">
                    <strong>{{ __('Country') }}:</strong>
                </dt>
                <dd class="col-8 col-xxl-9 mb-0">
                    <p class="mb-1">{{ $lead->contact->country }}</p>
                </dd>
            </dl>
            <form id="notes-form">
                <div class="mb-3">
                    <label for="note" class="form-label fw-bold">
                        <span class="d-flex align-items-center">
                            <i class="align-middle me-2 fas fa-fw fa-clipboard-list"></i>{{ __('Notes') }}
                        </span>
                    </label>
                    <input id="note" class="form-control" name="note" placeholder="{{ __('Add note...') }}" />
                    <small class="text-info"><em>*press Enter to save note</em></small>
                </div>
            </form>
            <hr>
            <div class="d-flex flex-column">
                <div class="note mb-3">
                    <div class="d-flex flex-column">
                        <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <span style="font-size: 11px;"><em><strong>Created by</strong> John doe</em></span>
                        <span style="font-size: 11px;"><strong><em>13/03/2023 09:14:43</em></strong></span>
                    </div>
                    <div class="d-flex gap-1">
                        <span class="cursor-pointer">
                            <i class="align-middle me-2 fas fa-fw fa-pen text-info"></i>
                        </span>
                        <span class="cursor-pointer">
                            <i class="align-middle me-2 fas fa-fw fa-trash text-danger"></i>
                        </span>
                    </div>
                </div>
                <div class="note mb-3">
                    <div class="d-flex flex-column">
                        <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <span style="font-size: 11px;"><em><strong>Created by</strong> John doe</em></span>
                        <span style="font-size: 11px;"><strong><em>13/03/2023 09:14:43</em></strong></span>
                    </div>
                    <div class="d-flex gap-1">
                        <span class="cursor-pointer">
                            <i class="align-middle me-2 fas fa-fw fa-pen text-info"></i>
                        </span>
                        <span class="cursor-pointer">
                            <i class="align-middle me-2 fas fa-fw fa-trash text-danger"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
