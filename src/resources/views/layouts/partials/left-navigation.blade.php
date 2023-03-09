<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        @if( config('sales-management.logoPath'))
            <a class="sidebar-brand" href="{{ config('sales-management.logoLink') }}">
                <img style="width: 100%" src="{{ config('sales-management.logoPath') }}" alt="Sales Management">
            </a>
        @endif
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                {{__("Sales Management")}}
            </li>
            <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span
                        class="align-middle">{{ __("Dashboard")}}</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('contacts*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('contacts.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span
                        class="align-middle">{{ __("Contacts")}}</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('list*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('lists.index') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">{{ __("Lists")}}</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('campaign*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('campaign.index') }}">
                    <i class="align-middle" data-feather="thumbs-up"></i> <span
                        class="align-middle">{{ __("Campaigns")}}</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('pipelines*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('pipelines.index') }}">
                    <i class="align-middle" data-feather="list"></i> <span
                        class="align-middle">{{ __("Pipelines")}}</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('tags*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('tags.index') }}">
                    <i class="align-middle" data-feather="tag"></i> <span class="align-middle">{{ __("Tags")}}</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
