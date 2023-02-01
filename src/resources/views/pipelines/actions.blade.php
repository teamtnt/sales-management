<div class="d-flex align-items-center">
    <a href="{{ route('pipelines.edit', $id) }}" class="btn btn-sm btn-warning d-inline me-1">Edit</a>
    <form action="{{ route('pipelines.destroy', $id) }}" method="POST">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to remove this pipeline?')"> Delete</button>
    </form>
</div>

