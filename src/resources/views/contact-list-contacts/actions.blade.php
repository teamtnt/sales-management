<div class="d-flex align-items-center">
    <form action="{{ route('teamtnt.sales-management.lists.contact.destroy', $model->pivot->id) }}" method="POST">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to remove this item?')"> {{__('Remove')}}</button>
    </form>
</div>

