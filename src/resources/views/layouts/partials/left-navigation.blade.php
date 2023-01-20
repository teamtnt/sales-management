<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        @if( config('sales-management.logoPath'))
        <a class="sidebar-brand" href="{{ config('sales-management.logoLink') }}">
            <img width="100%" src="{{ config('sales-management.logoPath') }}" alt="Sales Management">
        </a>
        @endif
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                {{__("Sales Management")}}
            </li>
            <li class="sidebar-item {{ (Route::currentRouteName() == "dashboard") ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span
                        class="align-middle">{{ __("Dashboard")}}</span>
                </a>
            </li>

            <li class="sidebar-item {{ (Route::currentRouteName() == "contacts.index") ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('contacts.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">{{ __("Contacts")}}</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">{{ __("Companies")}}</span>
                </a>
            </li>
            
            <li class="sidebar-item ">
                <a class="sidebar-link" href="">
                    <i class="align-middle" data-feather="thumbs-up"></i> <span class="align-middle">{{ __("Task List")}}</span>
                </a>
            </li>

            <li class="sidebar-item {{ (Route::currentRouteName() == "pipelines.index") ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('pipelines.index') }}">
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">{{ __("Pipelines")}}</span>
                </a>
            </li>
            <li class="sidebar-item ">
                <a class="sidebar-link" href="">
                    <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">{{ __("Deals")}}</span>
                </a>
            </li>
            <li class="sidebar-item ">
                <a class="sidebar-link" href="">
                    <i class="align-middle" data-feather="play-circle"></i> <span class="align-middle">{{ __("Automation")}}</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
