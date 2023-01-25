<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {{ Form::label('firstname', __('First name'), ['class' => 'form-label']) }}
            {{ Form::text('firstname', null, ['class' => 'form-control '.($errors->has('firstname') ? ' is-invalid' : ''), 'placeholder' => __('Your first name')]) }}
            @error('firstname')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ Form::label('lastname', __('Last name'), ['class' => 'form-label']) }}
            {{ Form::text('lastname', null, ['class' => 'form-control '.($errors->has('lastname') ? ' is-invalid' : '') , 'placeholder' => __('Your last name')]) }}
            @error('lastname')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

<div class="mb-3">
    {{ Form::label('job_title', __('Job title'), ['class' => 'form-label']) }}
    {{ Form::text('job_title', null, ['class' => 'form-control '.($errors->has('job_title') ? ' is-invalid' : '') , 'placeholder' => __('Your job title')]) }}
    @error('job_title')
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    {{ Form::label('email', __('Email'), ['class' => 'form-label']) }}
    {{ Form::text('email', null, ['class' => 'form-control ' .($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => __('Your email')]) }}
    @error('email')
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    {{ Form::label('phone', __('Phone'), ['class' => 'form-label']) }}
    {{ Form::text('phone', null, ['class' => 'form-control '.($errors->has('phone') ? ' is-invalid' : '') , 'placeholder' => __('Your phone ')]) }}
    @error('phone')
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    {{ Form::label('salutation', __('Salutation'), ['class' => 'form-label']) }}
    {{ Form::text('salutation', null, ['class' => 'form-control ' .($errors->has('salutation') ? ' is-invalid' : ''), 'placeholder' => __('Your salutation')]) }}
    @error('salutation')
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>





