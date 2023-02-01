<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {{ Form::label('name', __('Pipeline name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control '.($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => __('Enter pipeline name')]) }}
            @error('name')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ Form::label('description', __('Pipeline description'), ['class' => 'form-label']) }}
            {{ Form::text('description', null, ['class' => 'form-control '.($errors->has('description') ? ' is-invalid' : '') , 'placeholder' => __('Enter pipeline description')]) }}
            @error('description')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
<hr>
<div class="col-12">
    <div class="my-3">
        <h5>Add Pipeline Stages</h5>
    </div>
    <div class="mb-3">
        <pipeline-stage-repeater
            :stages="{{ json_encode($pipeline->pipelineStages ?? []) }}">
        </pipeline-stage-repeater>
    </div>
</div>

