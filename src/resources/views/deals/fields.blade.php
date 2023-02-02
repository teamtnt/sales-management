<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {{ Form::label('name', __('Deal name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control '.($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => __('Enter deal name')]) }}
            @error('name')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ Form::label('description', __('Deal description'), ['class' => 'form-label']) }}
            {{ Form::text('description', null, ['class' => 'form-control '.($errors->has('description') ? ' is-invalid' : '') , 'placeholder' => __('Enter deal description')]) }}
            @error('description')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ Form::label('worth', __('Deal worth'), ['class' => 'form-label']) }}
            {{ Form::text('worth', null, ['class' => 'form-control '.($errors->has('worth') ? ' is-invalid' : '') , 'placeholder' => __('Enter deal worth')]) }}
            @error('worth')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

