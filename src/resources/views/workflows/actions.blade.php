<div class="d-flex align-items-center">
    <a href="{{ route('workflows.show', [$task_id, $id]) }}" class="btn btn-sm btn-primary d-inline me-1">{{ __('Show') }}</a>
    <a href="{{ route('workflows.edit', [$task_id, $id]) }}" class="btn btn-sm btn-warning d-inline me-1">{{ __('Edit') }}</a>
    <form action="{{ route('workflows.destroy', [$task_id, $id]) }}" method="POST">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to remove this workflow?')">{{ __('Delete') }}</button>
    </form>
</div>

