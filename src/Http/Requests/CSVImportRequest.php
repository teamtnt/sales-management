<?php

namespace Teamtnt\SalesManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Teamtnt\SalesManagement\Models\ContactList;

class CSVImportRequest extends FormRequest
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
        $contactListTable = app(ContactList::class)->getTable();

        return [
            'csv' => 'required|mimes:csv',
            'contact_list_id' => "required_without:new_list|exists:{$contactListTable},id|nullable",
        ];
    }
}
