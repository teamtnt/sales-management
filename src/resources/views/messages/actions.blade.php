<div class="d-flex align-items-center">
    <a href="{{ route('messages.edit', [$task_id, $id]) }}" class="btn btn-sm btn-warning d-inline me-1">Edit</a>
    <form action="{{ route('messages.destroy', [$task_id, $id]) }}" method="POST">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to remove this message?')"> Delete</button>
    </form>
</div>

