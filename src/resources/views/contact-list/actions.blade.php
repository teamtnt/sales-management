<div class="d-flex align-items-center">
    <a href="{{ route('teamtnt.sales-management.lists.edit', $id) }}" class="btn btn-sm btn-warning d-inline me-1">{{__('Edit')}}</a>
    <form action="{{ route('teamtnt.sales-management.lists.destroy', $id) }}" method="POST">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to remove this item?')"> {{__('Delete')}}</button>
    </form>
</div>

