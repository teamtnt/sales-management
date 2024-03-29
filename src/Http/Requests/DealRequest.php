<?php

namespace Teamtnt\SalesManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealRequest extends FormRequest
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
            'name'                          => 'required|string',
            'description'                   => 'nullable|string',
            'worth'                         => 'required|integer',
        ];
    }
}
