@props(['campaign' => $campaign, 'lead' => $lead, 'offCanvas' => false])

<div class="lead-item card mb-3 p-2 bg-light border gap-1" data-lead-id="{{ $lead->id }}">

    <!-- Drag Handle -->
    <span class="drag-handle"
        style="
        display: inline-block;
        width: 20px;
        cursor: grab;
        margin-bottom: 5px;
        color: #a7a7a7;">
        <i style="pointer-events: none;" class="align-middle" data-feather="move"></i>
    </span>

    <div class="d-flex align-items-center">
        <x-sales-management::icons.user class="flex-shrink-0" />
        <span class="ms-2 lead-name"><a target="_blank"
                href="{{ route('teamtnt.sales-management.contacts.edit', $lead->contact) }}">{{ $lead->contact->firstname }}
                {{ $lead->contact->lastname }}</a></span>
    </div>
    <div class="d-flex align-items-center">
        <x-sales-management::icons.mail />
        <span class="ms-2 lead-email">{{ $lead->contact->email }}</span>
    </div>
    <div class="d-flex align-items-center">
        <x-sales-management::icons.phone />
        <span class="ms-2"> {{ $lead->contact->phone }}</span>
    </div>
    <div class="d-flex align-items-center">
        @if ($lead->contact->tags->count() > 0 || $lead->tags->count() > 0)
            <x-sales-management::icons.tag class="me-2 flex-shrink-0" />
            <ul class="list-unstyled d-flex flex-wrap m-0" style="gap: 2px 3px;">
                @foreach ($lead->contact->tags as $tag)
                    <li class="badge rounded-pill bg-info fw-light">{{ $tag->name }}</li>
                @endforeach
                @foreach ($lead->tags as $tag)
                    <li class="badge rounded-pill bg-info fw-light">{{ $tag->name }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    @if ($lead->nextCallActivity)
        <div class="d-flex align-items-center">
            <x-sales-management::icons.phone />
            <span class="ms-2"> {{ $lead->nextCallActivity->start_date->format('d.m.Y H:i') }}</span>
        </div>
    @endif

    @if ($offCanvas)
        @php
            $routes = collect([
                'notes' => [
                    'store' => route('teamtnt.sales-management.store-lead-note', $lead->id),
                    'delete' => route('teamtnt.sales-management.destroy-lead-note', [$lead->id, ':noteId']),
                ],
                'activities' => [
                    'store' => route('teamtnt.sales-management.store-lead-activity', $lead->id),
                    'delete' => route('teamtnt.sales-management.destroy-lead-activity', [$lead->id, ':activityId']),
                ],
                'contacts' => [
                    'syncTags' => route('teamtnt.sales-management.contacts.sync-tags', $lead->contact->id),
                    'syncLists' => route('teamtnt.sales-management.contacts.sync-lists', $lead->contact->id),
                ],
                'leads' => [
                    'syncTags' => route('teamtnt.sales-management.leads.sync-tags', $lead->id),
                ],
                'messages' => [
                    'send' => route('teamtnt.sales-management.send.message', [$campaign, $lead]),
                ],
            ]);
        @endphp

        <off-canvas-toggle :lead="{{ $lead->toJson() }}" :routes="{{ $routes->toJson() }}" :tags="{{ getAllTags() }}"
            :lists="{{ getAllLists() }}" :emails="{{ json_encode(config('sales-management.emails')) }}"
            :key="{{ $lead->id }}" />
    @endif
</div>
