<?php

namespace Teamtnt\SalesManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name'    => 'required|string',
            'vat'     => 'required|string',
            'url'     => 'nullable|string',
            'email'   => 'nullable|email',
            'address' => 'required|string',
            'postal'  => 'required|numeric',
            'city'    => 'required|string',
            'country' => 'required|string|max:3',
        ];
    }
}
