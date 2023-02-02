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

            <li class="sidebar-item {{ (Route::currentRouteName() == "lists.index") ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('lists.index') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">{{ __("Lists")}}</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('companies*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('companies.index') }}">
                    <i class="align-middle" data-feather="home"></i> <span
                        class="align-middle">{{ __("Companies")}}</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('task*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('tasklist.index') }}">
                    <i class="align-middle" data-feather="thumbs-up"></i> <span
                        class="align-middle">{{ __("Task List")}}</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('pipelines*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('pipelines.index') }}">
                    <i class="align-middle" data-feather="list"></i> <span
                        class="align-middle">{{ __("Pipelines")}}</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('deals*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('deals.index') }}">
                    <i class="align-middle" data-feather="check-square"></i> <span
                            class="align-middle">{{ __("Deals")}}</span>
                </a>
            </li>
            <li class="sidebar-item {{ (request()->is('automation*')) ? 'active' : '' }}">
                <a data-bs-target="#elements" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="play-circle"></i> <span
                        class="align-middle">{{__("Automation")}}</span>
                </a>
                <ul id="elements"
                    class="sidebar-dropdown list-unstyled collapse {{ (request()->is('element*')) ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ (request()->is('element/actions')) ? 'active' : '' }}">
                        <a class="sidebar-link" href="#">{{__("Messages")}}</a>
                    </li>
                    <li class="sidebar-item {{ (request()->is('automation/workflow/new')) ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('automation.workflow.index') }}">{{__("Workflow")}}</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
