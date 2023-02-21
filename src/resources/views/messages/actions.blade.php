<div class="d-flex align-items-center">
    <a href="{{ route('messages.edit', [$task_id, $id]) }}" class="btn btn-sm btn-warning d-inline me-1">Edit</a>
    <form action="{{ route('messages.destroy', [$task_id, $id]) }}" method="POST">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button class="btn btn-sm btn-danger me-1" onclick="return confirm('Are you sure you want to remove this message?')"> Delete</button>
    </form>
    <form action="{{ route('messages.send', [$task_id, $id]) }}" method="POST">
        {{ csrf_field() }}
        <button class="btn btn-sm btn-info" onclick="return confirm('Are you sure you want to send this message?')">{{ __('Send to all') }}</button>
    </form>
</div>

