<?php

namespace Teamtnt\SalesManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Teamtnt\SalesManagement\Models\Campaign;
use Teamtnt\SalesManagement\Models\ContactList;

class WebhookImportRequest extends FormRequest
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
        $campaignTable = app(Campaign::class)->getTable();

        return [
            'contacts' => ['required', 'array'],
            'contact_list_id' => "required_without_all:new_list,campaign_id|exists:{$contactListTable},id|nullable",
            'campaign_id' => "required_without_all:new_list,contact_list_id|exists:{$campaignTable},id|nullable",
        ];
    }
}
