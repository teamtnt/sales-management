<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {{ Form::label('name', __('Task name'), ['class' => 'form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control '.($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => __('Enter task name')]) }}
            @error('name')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {{ Form::label('description', __('Task description'), ['class' => 'form-label']) }}
            {{ Form::text('description', null, ['class' => 'form-control '.($errors->has('lastname') ? ' is-invalid' : '') , 'placeholder' => __('Enter task description')]) }}
            @error('description')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="mb-3">
        {{ Form::label('pipeline_id', __('Pipeline'), ['class' => 'form-label']) }}
        {{ Form::select('pipeline_id', \Teamtnt\SalesManagement\Models\Pipeline::getPipelineTexts(), null, ['class' => 'form-control ' .($errors->has('pipeline_id') ? ' is-invalid' : ''), 'placeholder' => 'Select a pipeline...']) }}
        @error('pipeline_id')
        <small class="invalid-feedback">{{ $message }}</small>
        @enderror
    </div>

</div>
<div class="row">
    <div class="mb-3">
        {{ Form::label('contact_list_id', __('Contact List'), ['class' => 'form-label']) }}
        {{ Form::select('contact_list_id', \Teamtnt\SalesManagement\Models\ContactList::getContactListTexts(), null, ['class' => 'form-control ' .($errors->has('contact_list_id') ? ' is-invalid' : ''), 'placeholder' => 'Select a contactlist...']) }}
        @error('contact_list_id')
        <small class="invalid-feedback">{{ $message }}</small>
        @enderror
    </div>

</div>
