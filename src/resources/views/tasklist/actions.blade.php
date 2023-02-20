<div class="d-flex align-items-center">
    <a href="{{ route('tasklist.show', $id) }}" class="btn btn-sm btn-success d-inline me-1">{{__('Show')}}</a>
    <a href="{{ route('tasklist.edit', $id) }}" class="btn btn-sm btn-warning d-inline me-1">{{__('Edit')}}</a>
    <form action="{{ route('tasklist.destroy', $id) }}" method="POST">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to remove this item?')"> {{__('Delete')}}</button>
    </form>
</div>

