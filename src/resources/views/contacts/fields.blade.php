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

<div class="mb-3">
    {{ Form::label('company_name', __('Company name'), ['class' => 'form-label']) }}
    {{ Form::text('company_name', null, ['class' => 'form-control '.($errors->has('company_name') ? ' is-invalid' : ''), 'placeholder' => __('Company name')]) }}
    @error('company_name')
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
            {{ Form::label('url', __('Company website'), ['class' => 'form-label']) }}
            {{ Form::text('url', null, ['class' => 'form-control '.($errors->has('url') ? ' is-invalid' : ''), 'placeholder' => __('Enter Company webiste')]) }}
            @error('url')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            {{ Form::label('company_email', __('Company email'), ['class' => 'form-label']) }}
            {{ Form::text('company_email', null, ['class' => 'form-control '.($errors->has('company_email') ? ' is-invalid' : ''), 'placeholder' => __('Enter Company email')]) }}
            @error('company_email')
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
<div class="row">
    <div class="col-md-12">
        <multi-select-list
            name=tags[]
            label="Add tag to user"
            placeholder="Choose tags..."
            label-by="name"
            track-by="name"
            :selected="{{ $contact->tags->toJson() ?? '[]'}}"
            :options="{{ getAllTags() ?? '[]'}}">
        </multi-select-list>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <multi-select-list
            name=tags[]
            label="Add to Lists"
            placeholder="Choose list..."
            label-by="name"
            track-by="name"
            sync-tags-url="{{ route('teamtnt.sales-management.contacts.sync-lists', $contact->id) }}"
            model-id="{{ $contact->id }}"
            :selected="{{ $contact->lists->toJson() ?? '[]'}}"
            :options="{{ getAllLists() ?? '[]'}}">
        </multi-select-list>
    </div>
</div>








