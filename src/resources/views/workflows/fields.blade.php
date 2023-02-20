<input type="hidden" name="task_id" value="{{ $task->id }}">

<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            {{ Form::label('name', __('Workflow name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control '.($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => __('Enter workflow name')]) }}
            @error('name')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            {{ Form::label('description', __('Workflow description'), ['class' => 'form-label']) }}
            {{ Form::text('description', null, ['class' => 'form-control '.($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => __('Enter workflow description')]) }}
            @error('description')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            {{ Form::label('elements', __('Workflow elements'), ['class' => 'form-label']) }}
            {{ Form::textarea('elements', null, ['class' => 'form-control '.($errors->has('elements') ? ' is-invalid' : ''), 'placeholder' => __('Enter workflow elements json')]) }}
            @error('elements')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <input type="hidden" value="{{ \Teamtnt\SalesManagement\Models\Status::WORKFLOW_STATUS_NEW }}">
</div>

