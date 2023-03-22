<div class="col-12 col-sm-6 col-xl-auto flex-grow-1 d-flex">
    <div class="card flex-fill">
        <div class="card-body py-4">
            <div class="d-flex align-items-start">
                <div class="flex-grow-1">
                    <h3 class="mb-2">{{ $bouncesCount }}</h3>
                    <p class="mb-2">{{ __("Bounces") }}</p>
                    <div class="mb-0">
                        <span class="badge badge-soft-success me-2">{{ number_format($bounceRate, 2) }}%</span>
                        <span class="text-muted">{{ __("Bounce rate") }}</span>
                    </div>
                </div>
                <div class="d-inline-block ms-3">
                    <div class="stat">
                        <x-sales-management::icons.bounce-mail/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
