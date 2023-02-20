<div class="d-flex align-items-center">


    <div class="dropdown position-relative">
        <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
            {{ __('Action') }}
        </a>

        <div class="dropdown-menu dropdown-menu-end">
            <a href="{{ route('workflows.index', $id) }}" class="dropdown-item">{{__('Workflows')}}</a>
            <a href="{{ route('messages.index', $id) }}" class="dropdown-item">{{__('Messages')}}</a>
            <a href="{{ route('tasklist.show', $id) }}" class="dropdown-item">{{__('Show')}}</a>
            <a href="{{ route('tasklist.edit', $id) }}" class="dropdown-item">{{__('Edit')}}</a>
            <form action="{{ route('tasklist.destroy', $id) }}" method="POST">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button class="dropdown-item" onclick="return confirm('Are you sure you want to remove this item?')"> {{__('Delete')}}</button>
            </form>
        </div>
    </div>
</div>

