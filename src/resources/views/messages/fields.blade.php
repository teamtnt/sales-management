<input type="hidden" name="task_id" value="{{ $task->id }}">

<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            {{ Form::label('from_email', __('From'), ['class' => 'form-label']) }}
            {{ Form::select('from_email', config('sales-management.emails'), null, ['class' => 'form-control '.($errors->has('from_email') ? ' is-invalid' : ''), 'placeholder' => __('Select')]) }}
            @error('from_email')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            {{ Form::label('subject', __('Subject'), ['class' => 'form-label']) }}
            {{ Form::text('subject', null, ['class' => 'form-control '.($errors->has('subject') ? ' is-invalid' : '') , 'placeholder' => __('Enter subject')]) }}
            @error('subject')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <text-area
                name="body"
                error-message="{{ $errors->first('body') }}"
                message-body="{{ $message->body ?? '' }}">
        </text-area>
    </div>
</div>

