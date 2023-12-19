<div class="d-flex align-items-center">
    <a href="{{ route('teamtnt.sales-management.deals.edit', $id) }}" class="btn btn-sm btn-warning d-inline me-1">Edit</a>
    <form action="{{ route('teamtnt.sales-management.deals.destroy', $id) }}" method="POST">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to remove this deal?')"> Delete</button>
    </form>
</div>

