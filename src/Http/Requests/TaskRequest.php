<?php

namespace Teamtnt\SalesManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Teamtnt\SalesManagement\Models\ContactList;
use Teamtnt\SalesManagement\Models\Pipeline;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $pipelineTable = app(Pipeline::class)->getTable();
        $contactListTable = app(ContactList::class)->getTable();

        return [
            'name'            => 'required|string',
            'description'     => 'nullable|string',
            'assignees'       => 'nullable|array',
            'status'          => 'nullable|integer',
            'pipeline_id'     => "required|exists:{$pipelineTable},id",
            'contact_list_id' => "nullable|exists:{$contactListTable},id",
        ];
    }
}
