<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        @if( config('sales-management.logoPath'))
        <a class="sidebar-brand" href="/">
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
        </ul>
    </div>
</nav>
