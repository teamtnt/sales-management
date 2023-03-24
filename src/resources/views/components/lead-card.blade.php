@props(['lead' => $lead, 'offCanvas' => false])

<div class="lead-item card mb-3 p-2 bg-light border gap-1" data-lead-id="{{ $lead->id }}">
    <div class="d-flex align-items-center">
        <x-sales-management::icons.user />
        <span class="ms-2">{{ $lead->contact->firstname }} {{ $lead->contact->lastname }}</span>
    </div>
    <div class="d-flex align-items-center">
        <x-sales-management::icons.mail />
        <span class="ms-2 lead-email">{{ $lead->contact->email }}</span>
    </div>
    <div class="d-flex align-items-center">
        <x-sales-management::icons.phone />
        <span class="ms-2"> {{ $lead->contact->phone }}</span>
    </div>
    @if($offCanvas)
        <span class="info-icon" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight-{{ $lead->contact->id }}"
              aria-controls="offcanvasRight">
        <x-sales-management::icons.info />
    </span>
    @endif
</div>

@if($offCanvas)
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight-{{ $lead->contact->id }}"
         aria-labelledby="offcanvasRightLabel-{{$lead->contact->id}}">
    <div class="offcanvas-header bg-light border-bottom">
        <h4 class="offcanvas-title" id="offcanvasRightLabel-{{$lead->contact->id}}">
            <span class="d-flex">
                <x-sales-management::icons.user class="me-2" style="width: 24px; height: 24px;" /> {{ __('User') }}: {{
                $lead->contact->fullname }}
            </span>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <ul class="nav nav-tabs" id="lead-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active text-uppercase" id="home-tab" data-bs-toggle="tab"
                    data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane"
                    aria-selected="true">{{ __('Profile details') }}</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-uppercase" id="profile-tab" data-bs-toggle="tab"
                    data-bs-target="#message-tab-pane" type="button" role="tab" aria-controls="message-tab-pane"
                    aria-selected="false">{{ __('Send Message') }}</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
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
                </dl>
                @if(count($lead->contact->tags) > 0)
                    <div class="mb-4">
                    <span class="d-flex fw-bold align-items-center mb-2">
                        <x-sales-management::icons.tag class="me-2" /> {{ __('Tags') }}
                    </span>
                    <ul class="list-unstyled d-flex flex-wrap gap-1">
                        @foreach($lead->contact->tags as $tag)
                            <li class="badge rounded-pill bg-info fw-light">{{ $tag->name }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <notes lead-id="{{ $lead->id }}" :lead-notes="{{ $lead->notes->toJson() }}"
                       url="{{route('store-lead-note', $lead->id)}}"
                       delete-url="{{ route('destroy-lead-note', [$lead->id, " :noteId"]) }}">
                </notes>
            </div>
        </div>
        <div class="tab-pane fade" id="message-tab-pane" role="tabpanel" aria-labelledby="message-tab" tabindex="0">
            <div class="offcanvas-body">
                <form>
                    <div class="mb-3">
                        {{ Form::label('from_email', __('From'), ['class' => 'form-label']) }}
                        {{ Form::select('from_email', config('sales-management.emails'), null, ['class' => 'form-control
                        '.($errors->has('from_email') ? ' is-invalid' : ''), 'placeholder' => __('Select')]) }}
                        @error('from_email')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        {{ Form::label('subject', __('Subject'), ['class' => 'form-label']) }}
                        {{ Form::text('subject', null, ['class' => 'form-control '.($errors->has('subject') ? '
                        is-invalid' : '') , 'placeholder' => __('Enter subject')]) }}
                        @error('subject')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        {{ Form::label('message', __('Message'), ['class' => 'form-label']) }}
                        {{ Form::textarea('message', null, ['class' => 'form-control']) }}
                        @error('subject')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="my-3">
                        <button type="submit" class="btn btn-success me-2 w-100">{{__("Send Message")}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
