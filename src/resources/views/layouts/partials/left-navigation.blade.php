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
            @can(config('sales-management.prefix').'.view-dashboard')
                <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('dashboard') }}">
                        <i class="align-middle" data-feather="sliders"></i> <span
                            class="align-middle">{{ __("Dashboard")}}</span>
                    </a>
                </li>
            @endcan
            @can(config('sales-management.prefix').'.view-contacts')
                <li class="sidebar-item {{ request()->is('contacts*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('contacts.index') }}">
                        <i class="align-middle" data-feather="user"></i> <span
                            class="align-middle">{{ __("Contacts")}}</span>
                    </a>
                </li>
            @endcan
            @can(config('sales-management.prefix').'.view-lists')
                <li class="sidebar-item {{ request()->is('list*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('lists.index') }}">
                        <i class="align-middle" data-feather="clipboard"></i> <span
                            class="align-middle">{{ __("Lists")}}</span>
                    </a>
                </li>
            @endcan
            @can(config('sales-management.prefix').'.view-campaigns')
                <li class="sidebar-item {{ request()->is('campaign*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('campaign.index') }}">
                        <i class="align-middle me-2 fas fa-fw fa-bullhorn"></i> <span
                            class="align-middle">{{ __("Campaigns")}}</span>
                    </a>
                </li>
            @endcan
            @can(config('sales-management.prefix').'.view-pipelines')
                <li class="sidebar-item {{ request()->is('pipelines*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('pipelines.index') }}">
                        <i class="align-middle" data-feather="list"></i> <span
                            class="align-middle">{{ __("Pipelines")}}</span>
                    </a>
                </li>
            @endcan
            @can(config('sales-management.prefix').'.view-tags')
                <li class="sidebar-item {{ request()->is('tags*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('tags.index') }}">
                        <i class="align-middle" data-feather="tag"></i> <span
                            class="align-middle">{{ __("Tags")}}</span>
                    </a>
                </li>
            @endcan
            @can(config('sales-management.prefix').'.view-docs')
                <li class="sidebar-item {{ request()->is('docs*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="#docsMenu" data-bs-toggle="collapse" aria-expanded="false">
                        <i class="align-middle" data-feather="book"></i> <span class="align-middle">Docs</span>
                    </a>
                    <ul id="docsMenu"
                        class="sidebar-dropdown list-unstyled collapse {{ request()->is('docs*') ? 'show' : '' }}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{ request()->is('docs/markdown') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('docs.markdown') }}">Markdown</a>
                        </li>
                        <li class="sidebar-item {{ request()->is('docs/pipelines') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('docs.pipelines') }}">Pipelines</a>
                        </li>
                        <li class="sidebar-item {{ request()->is('docs/workflow') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('docs.workflow') }}">Workflow</a>
                        </li>
                    </ul>
                </li>
            @endcan
        </ul>
    </div>
</nav>
