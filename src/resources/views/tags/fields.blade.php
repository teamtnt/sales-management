<div class="mb-3">
    {{ Form::label('name', __('Tag name'), ['class' => 'form-label']) }}
    {{ Form::text('name', null, ['class' => 'form-control '.($errors->has('name') ? ' is-invalid' : '') , 'placeholder' => __('Enter tag name')]) }}
    @error('name')
    <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    {{ Form::label('description', __('Tag description'), ['class' => 'form-label']) }}
    {{ Form::textarea('description', null, ['class' => 'form-control ' .($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => __('Enter tag description')]) }}
    @error('description')
    <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>











