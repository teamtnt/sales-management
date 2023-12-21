<div class="d-flex align-items-center">
    <a href="{{ route('teamtnt.sales-management.workflows.debug', [$campaign_id, $id]) }}"
       class="btn btn-sm btn-info d-inline me-1">{{ __('Debug Machine') }}</a>
    <form action="{{ route('teamtnt.sales-management.workflows.destroy', [$campaign_id, $id]) }}" method="POST">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button class="btn btn-sm btn-danger me-1"
                onclick="return confirm('Are you sure you want to remove this workflow?')">{{ __('Delete') }}</button>
    </form>
    @if($model->status === 0)
        <a href="{{ route('teamtnt.sales-management.workflows.edit', [$campaign_id, $id]) }}"
           class="btn btn-sm btn-warning d-inline me-1">{{ __('Edit') }}</a>
        <form action="{{ route('teamtnt.sales-management.workflows.publish', [$campaign_id, $id]) }}" method="POST">
            {{ csrf_field() }}
            <button class="btn btn-sm btn-success"
                    onclick="return confirm('Are you sure you want to publish this workflow?')">{{ __('Publish') }}</button>
        </form>
    @elseif($model->status === 1)
        <a href="{{ route('teamtnt.sales-management.workflows.show', [$campaign_id, $id]) }}"
           class="btn btn-sm btn-info d-inline me-1">{{ __('Show') }}</a>
        <form action="{{ route('teamtnt.sales-management.workflows.unpublish', [$campaign_id, $id]) }}" method="POST">
            {{ csrf_field() }}
            <button class="btn btn-sm btn-warning d-inline me-1"
                    onclick="return confirm('Are you sure you want to unpublish this workflow?')">{{ __('Unpublish') }}</button>
        </form>
        <form action="{{ route('teamtnt.sales-management.workflows.run', [$campaign_id, $id]) }}" method="POST">
            {{ csrf_field() }}
            <button class="btn btn-sm btn-info"
                    onclick="return confirm('Are you sure you want to run this workflow?')">{{ __('RUN') }}</button>
        </form>
    @endif
</div>

