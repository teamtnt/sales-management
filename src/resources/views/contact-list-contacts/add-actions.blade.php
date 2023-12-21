<div class="d-flex align-items-center">
    <form action="{{ route('teamtnt.sales-management.lists.contact.add', $contactList) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" value="{{ $model->id }}" name="contact_id">
        @if(!in_array($model->id, $contactList->contacts->pluck('id')->toArray()))
            <button class="btn btn-sm btn-success"> {{__('Add')}}</button>
        @endif
    </form>
</div>

