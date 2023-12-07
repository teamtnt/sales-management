<div class="d-flex align-items-center">
    <div class="dropdown position-relative">
        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-bs-toggle="dropdown"
                data-bs-display="static">
            {{ __('Action') }}
        </button>

        <div class="dropdown-menu dropdown-menu-end">
            @can(config('sales-management.permission_prefix').'.view-workflows')
                <a href="{{ route('workflows.index', $id) }}" class="dropdown-item">{{__('Workflows')}}</a>
            @endcan
            @can(config('sales-management.permission_prefix').'.view-messages')
                <a href="{{ route('messages.index', $id) }}" class="dropdown-item">{{__('Messages')}}</a>
            @endcan
            <a href="{{ route('campaign.show', $id) }}" class="dropdown-item">{{__('Show')}}</a>
            <a href="{{ route('campaign.edit', $id) }}" class="dropdown-item">{{__('Edit')}}</a>
            <form action="{{ route('campaign.destroy', $id) }}" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button class="dropdown-item"
                        onclick="return confirm('Are you sure you want to remove this item?')"> {{__('Delete')}}</button>
            </form>
        </div>
    </div>
</div>

