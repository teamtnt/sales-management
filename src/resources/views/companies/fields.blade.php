<div class="mb-3">
    {{ Form::label('name', __('Company name'), ['class' => 'form-label']) }}
    {{ Form::text('name', null, ['class' => 'form-control '.($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => __('Company name')]) }}
    @error('name')
    <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>

<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            {{ Form::label('vat', __('Company VAT'), ['class' => 'form-label']) }}
            {{ Form::text('vat', null, ['class' => 'form-control '.($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => __('Enter Company VAT number')]) }}
            @error('vat')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            {{ Form::label('url', __('Company webiste'), ['class' => 'form-label']) }}
            {{ Form::text('url', null, ['class' => 'form-control '.($errors->has('url') ? ' is-invalid' : ''), 'placeholder' => __('Enter Company webiste')]) }}
            @error('url')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
     <div class="col-md-4">
        <div class="mb-3">
            {{ Form::label('email', __('Company email'), ['class' => 'form-label']) }}
            {{ Form::text('email', null, ['class' => 'form-control '.($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => __('Enter Company email')]) }}
            @error('email')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {{ Form::label('address', __('Address'), ['class' => 'form-label']) }}
            {{ Form::text('address', null, ['class' => 'form-control '.($errors->has('address') ? ' is-invalid' : ''), 'placeholder' => __('Enter Company address')]) }}
            @error('address')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ Form::label('postal', __('ZIP'), ['class' => 'form-label']) }}
            {{ Form::text('postal', null, ['class' => 'form-control '.($errors->has('postal') ? ' is-invalid' : ''), 'placeholder' => __('Enter postal code')]) }}
            @error('postal')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {{ Form::label('city', __('City'), ['class' => 'form-label']) }}
            {{ Form::text('city', null, ['class' => 'form-control '.($errors->has('city') ? ' is-invalid' : ''), 'placeholder' => __('Enter city')]) }}
            @error('city')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ Form::label('country', __('Country'), ['class' => 'form-label']) }}
            {{ Form::text('country', 'DE', ['class' => 'form-control '.($errors->has('country') ? ' is-invalid' : ''), 'placeholder' => __('Enter country')]) }}
            @error('country')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>






