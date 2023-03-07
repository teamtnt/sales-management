<div class="d-flex align-items-center">
    <a href="{{ route('tags.edit', $id) }}" class="btn btn-sm btn-warning d-inline me-1">{{__('Edit')}}</a>
    <form action="{{ route('tags.destroy', $id) }}" method="POST">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to remove this tag?')"> {{__('Delete')}}</button>
    </form>
</div>

