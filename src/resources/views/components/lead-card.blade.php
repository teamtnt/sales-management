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
        <span class="info-icon" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
            <x-sales-management::icons.info />
        </span>
    @endif
</div>

@if($offCanvas)
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Offcanvas right</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            ...
        </div>
    </div>
@endif
