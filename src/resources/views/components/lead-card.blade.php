@props(['campaign' => $campaign, 'lead' => $lead, 'offCanvas' => false])

<div class="lead-item card mb-3 p-2 bg-light border gap-1" data-lead-id="{{ $lead->id }}">

    <!-- Drag Handle -->
    <span class="drag-handle" style="
        display: inline-block;
        width: 20px;
        cursor: grab;
        margin-bottom: 5px;
        color: #a7a7a7;">
        <i style="pointer-events: none;" class="align-middle" data-feather="move"></i>
    </span>

    <div class="d-flex align-items-center">
        <x-sales-management::icons.user class="flex-shrink-0"/>
        <span class="ms-2"><a target="_blank" href="{{ route('teamtnt.sales-management.contacts.edit', $lead->contact)  }}">{{ $lead->contact->firstname }} {{ $lead->contact->lastname }}</a></span>
    </div>
    <div class="d-flex align-items-center">
        <x-sales-management::icons.mail/>
        <span class="ms-2 lead-email">{{ $lead->contact->email }}</span>
    </div>
    <div class="d-flex align-items-center">
        <x-sales-management::icons.phone/>
        <span class="ms-2"> {{ $lead->contact->phone }}</span>
    </div>
    <div class="d-flex align-items-center">
        @if($lead->contact->tags->count() > 0 || $lead->tags->count() > 0)
            <x-sales-management::icons.tag class="me-2 flex-shrink-0"/>
            <ul class="list-unstyled d-flex flex-wrap m-0" style="gap: 2px 3px;">
                @foreach($lead->contact->tags as $tag)
                    <li class="badge rounded-pill bg-info fw-light">{{ $tag->name }}</li>
                @endforeach
                @foreach($lead->tags as $tag)
                    <li class="badge rounded-pill bg-info fw-light">{{ $tag->name }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    @if($lead->nextCallActivity)
    <div class="d-flex align-items-center">
        <x-sales-management::icons.phone/>
        <span class="ms-2"> {{ $lead->nextCallActivity->start_date->format('d.m.Y H:i') }}</span>
    </div>
    @endif
    @if($offCanvas)
        <span class="info-icon" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight-{{ $lead->contact->id }}" data-form-id="{{$lead->id}}"
              aria-controls="offcanvasRight">
        <x-sales-management::icons.info style="pointer-events: none;"/>
    </span>
    @endif
</div>


@if($offCanvas)
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight-{{ $lead->contact->id }}"
         aria-labelledby="offcanvasRightLabel-{{$lead->contact->id}}">
        <div class="offcanvas-header bg-light border-bottom">
            <h4 class="offcanvas-title" id="offcanvasRightLabel-{{$lead->contact->id}}">
            <span class="d-flex">
                <x-sales-management::icons.user class="me-2 flex-shrink-0" style="width: 24px; height: 24px;"/> {{ __('User') }}:
                <a target="_blank" href="{{ route('teamtnt.sales-management.contacts.edit', $lead->contact)  }}">{{$lead->contact->fullname }}</a>


            </span>
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <ul class="nav nav-tabs" id="lead-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active text-uppercase" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#profile-tab-pane-{{ $lead->id }}" type="button" role="tab"
                        aria-controls="profile-tab-pane"
                        aria-selected="true">{{ __('Profile') }}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-uppercase" id="notes-tab" data-bs-toggle="tab"
                        data-bs-target="#notes-tab-pane-{{ $lead->id }}" type="button" role="tab"
                        aria-controls="notes-tab-pane"
                        aria-selected="false">{{ __('Notes') }}</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link text-uppercase" id="activities-tab" data-bs-toggle="tab"
                        data-bs-target="#activities-tab-pane-{{ $lead->id }}" type="button" role="tab"
                        aria-controls="activities-tab-pane"
                        aria-selected="false">{{ __('Activities') }}</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link text-uppercase" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#message-tab-pane-{{ $lead->id }}" type="button" role="tab"
                        aria-controls="message-tab-pane"
                        aria-selected="false">{{ __('Send E-Mail') }}</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent" style="overflow-y: auto;">
            <div class="tab-pane fade show active" id="profile-tab-pane-{{ $lead->id }}" role="tabpanel"
                 aria-labelledby="profile-tab"
                 tabindex="0">
                <div class="offcanvas-body">
                    <dl class="row mb-4">
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

                        <dt class="col-4 col-xxl-3 mb-0"><strong>{{ __('Lastname') }}:</strong></dt>
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
                        @if($lead->contact->external_profile_url)
                        <dt class="col-4 col-xxl-3 mb-0">
                            <strong>{{ __('Profile URL') }}:</strong>
                        </dt>
                        <dd class="col-8 col-xxl-9 mb-0">
                            <p class="mb-1"><a href="{{ $lead->contact->external_profile_url }}" target="_blank">{{ $lead->contact->external_profile_url }}</a></p>
                        </dd>
                        @endif
                    </dl>
                    <div class="mb-4">
                        <span class="d-flex fw-bold align-items-center mb-2">
                            <x-sales-management::icons.tag class="me-2"/> {{ __('Contact Tags') }}
                        </span>
                        @if($lead->contact->tags->count() > 0)
                            <ul class="list-unstyled d-flex flex-wrap m-0" style="gap: 2px 3px;">
                                @foreach($lead->contact->tags as $tag)
                                    <li class="badge rounded-pill bg-info fw-light">{{ $tag->name }}</li>
                                @endforeach
                            </ul>
                        @endif
{{--                        <multi-select-list--}}
{{--                            name=tags[]--}}
{{--                            label="Add tag to contact"--}}
{{--                            placeholder="Choose tags..."--}}
{{--                            label-by="name"--}}
{{--                            track-by="name"--}}
{{--                            sync-tags-url="{{ route('teamtnt.sales-management.contacts.sync-tags', $lead->contact->id) }}"--}}
{{--                            model-id="{{ $lead->contact->id }}"--}}
{{--                            :selected="{{ $lead->contact->tags->toJson() ?? '[]'}}"--}}
{{--                            :options="{{ getAllTags() ?? '[]'}}">--}}
{{--                        </multi-select-list>--}}
                    </div>
                    <div class="mb-4">
                        <span class="d-flex fw-bold align-items-center mb-2">
                            <x-sales-management::icons.tag class="me-2"/> {{ __('Lists') }}
                        </span>
                        @if($lead->contact->lists->count() > 0)
                            @foreach($lead->contact->lists as $list)
                                <li class="badge rounded-pill bg-info fw-light">{{ $list->name }}</li>
                            @endforeach
                        @endif

{{--                        <multi-select-list--}}
{{--                            name=tags[]--}}
{{--                            label="Add to Lists"--}}
{{--                            placeholder="Choose list..."--}}
{{--                            label-by="name"--}}
{{--                            track-by="name"--}}
{{--                            sync-tags-url="{{ route('teamtnt.sales-management.contacts.sync-lists', $lead->contact->id) }}"--}}
{{--                            model-id="{{ $lead->contact->id }}"--}}
{{--                            :selected="{{ $lead->contact->lists->toJson() ?? '[]'}}"--}}
{{--                            :options="{{ getAllLists() ?? '[]'}}">--}}
{{--                        </multi-select-list>--}}
                    </div>
                    <div class="mb-4">
                        <span class="d-flex fw-bold align-items-center mb-2">
                            <x-sales-management::icons.tag class="me-2"/> {{ __('Lead Tags') }}
                        </span>
                        @if($lead->tags->count() > 0)
                            @foreach($lead->tags as $tag)
                                <li class="badge rounded-pill bg-info fw-light">{{ $tag->name }}</li>
                            @endforeach
                        @endif
{{--                        <multi-select-list--}}
{{--                            name=tags[]--}}
{{--                            label="Add tag to lead"--}}
{{--                            placeholder="Choose tags..."--}}
{{--                            label-by="name"--}}
{{--                            track-by="name"--}}
{{--                            sync-tags-url="{{ route('teamtnt.sales-management.leads.sync-tags', $lead->id) }}"--}}
{{--                            model-id="{{ $lead->id }}"--}}
{{--                            :selected="{{ $lead->tags->toJson() ?? '[]'}}"--}}
{{--                            :options="{{ getAllTags() ?? '[]'}}">--}}
{{--                        </multi-select-list>--}}
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="notes-tab-pane-{{ $lead->id }}" role="tabpanel"
                 aria-labelledby="notes-tab" tabindex="0">
                <div class="offcanvas-body">
                <notes lead-id="{{ $lead->id }}" :lead-notes="{{ $lead->notes->toJson() }}"
                       url="{{route('teamtnt.sales-management.store-lead-note', $lead->id)}}"
                       delete-url="{{ route('teamtnt.sales-management.destroy-lead-note', [$lead->id, " :noteId"]) }}" :key="{{ $lead->id }}">
                </notes>
                </div>
            </div>

            <div class="tab-pane fade" id="activities-tab-pane-{{ $lead->id }}" role="tabpanel"
                 aria-labelledby="activities-tab" tabindex="0">
                <div class="offcanvas-body">
                    <activities lead-id="{{ $lead->id }}" :lead-activities="{{ $lead->activities->toJson() }}"
                           url="{{route('teamtnt.sales-management.store-lead-activity', $lead->id)}}"
                           delete-url="{{ route('teamtnt.sales-management.destroy-lead-activity', [$lead->id, " :activityId"]) }}" :key="{{ $lead->id }}">
                    </activities>
                </div>
            </div>

            <div class="tab-pane fade" id="message-tab-pane-{{ $lead->id }}" role="tabpanel"
                 aria-labelledby="message-tab" tabindex="0">
                <div class="offcanvas-body">
                    {{ Form::open(['method' => 'post', 'id' => 'lead-message-form-'.$lead->id, 'route' => ['send.message', [$campaign, $lead]]]) }}
                    <div class="mb-3">
                        {{ Form::label('from_email', __('From'), ['class' => 'form-label']) }}
                        {{ Form::select('from_email', config('sales-management.emails'), array_key_first(config('sales-management.emails')), ['class' => 'form-control', 'placeholder' => __('Select')]) }}
                        <small class="invalid-feedback"></small>
                    </div>
                    <div class="mb-3">
                        {{ Form::label('subject', __('Subject'), ['class' => 'form-label']) }}
                        {{ Form::text('subject', null, ['class' => 'form-control', 'placeholder' => __('Enter subject')]) }}
                        <small class="invalid-feedback"></small>
                    </div>
                    <div class="mb-3">
                        {{ Form::label('body', __('Message'), ['class' => 'form-label']) }}
                        {{ Form::textarea('body', null, ['class' => 'form-control']) }}
                        <small class="invalid-feedback"></small>
                    </div>
                    <div class="my-3">
                        <button type="submit" class="btn btn-success me-2 w-100">
                            <span class="d-flex align-items-center justify-content-center">
                                <span class="spinner d-none spinner-border spinner-border-sm text-light me-2" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </span>{{ __("Send Message")}}
                            </span>
                        </button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endif
