<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {{ Form::label('from_name', __('From name'), ['class' => 'form-label']) }}
            {{ Form::text('from_name', null, ['class' => 'form-control '.($errors->has('from_name') ? ' is-invalid' : ''), 'placeholder' => __('Enter from name')]) }}
            @error('from_name')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ Form::label('from_email', __('From email'), ['class' => 'form-label']) }}
            {{ Form::email('from_email', null, ['class' => 'form-control '.($errors->has('from_email') ? ' is-invalid' : '') , 'placeholder' => __('Enter from email')]) }}
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

