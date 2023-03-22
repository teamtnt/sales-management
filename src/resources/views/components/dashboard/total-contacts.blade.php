<div class="col-12 col-sm-6 col-xl-auto flex-grow-1 d-flex">
    <div class="card flex-fill">
        <div class="card-body py-4">
            <div class="d-flex align-items-start">
                <div class="flex-grow-1">
                    <h3 class="mb-2">{{ $totalContactsCount }}</h3>
                    <p class="mb-2">{{ __("Total Contacts") }}</p>
                    <div class="mb-0">
                        <span
                            class="badge {{ $percentageIncrease >= 0 ? 'badge-soft-success' : 'badge-soft-danger' }} me-2">{{ number_format($percentageIncrease, 2) }}%</span>
                        <span class="text-muted">{{ __("Since last month") }}</span>
                    </div>
                </div>
                <div class="d-inline-block ms-3">
                    <div class="stat">
                        <x-sales-management::icons.users/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
