<?php

namespace Teamtnt\SalesManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        return [
            'firstname'  => 'required|string',
            'lastname'   => 'required|string',
            'job_title'  => 'nullable|string',
            'email'      => 'required_if:phone,=,null|nullable|email',
            'phone'      => 'required_if:email,=,null|nullable|string',
            'salutation' => 'nullable|string'
        ];
    }
}
