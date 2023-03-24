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
            'csv' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!is_file($value)) {
                        return $fail("The $attribute must be a file.");
                    }
                    if (!$this->isCsvValid($value)) {
                        return $fail("The $attribute is not a valid CSV file.");
                    }
                },
            ],
            'contact_list_id' => "required_without:new_list|exists:{$contactListTable},id|nullable",
        ];
    }

    private function isCsvValid($filename)
    {
        $handle = fopen($filename, 'r');
        $firstLine = fgets($handle);
        fclose($handle);

        return strpos($firstLine, ',') !== false || strpos($firstLine, ';') !== false;
    }

}
