<?php

namespace Teamtnt\SalesManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'from_email' => 'required|email',
            'subject'    => 'required|string',
            'body'       => 'string',
            'task_id'    => 'required|int',
        ];
    }
}
