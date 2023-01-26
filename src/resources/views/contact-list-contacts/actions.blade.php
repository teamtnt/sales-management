<div class="d-flex align-items-center">
    <form action="{{ route('lists.contact.destroy', $contact_list_contact_id) }}" method="POST">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to remove this item?')"> {{__('Delete')}}</button>
    </form>
</div>

