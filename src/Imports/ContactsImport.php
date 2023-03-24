<?php

namespace Teamtnt\SalesManagement\Imports;

use Teamtnt\SalesManagement\Models\ContactTemp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\ValidationException;

class ContactsImport implements ToModel, WithStartRow, WithBatchInserts, WithCustomCsvSettings
{
    private $delimiter;
    private $encoding;

    public function __construct($delimiter = ',', $encoding = "UTF-8")
    {
        $this->delimiter = $delimiter;
        $this->encoding = $encoding;
    }
    /**
     * @param  array  $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $email = trim($row[4]);
        if (! isValidEmail($email)) {
            return null; // Skip rows with invalid email addresses
        }


        return new ContactTemp([
            'salutation'    => trim($row[0]),
            'firstname'     => trim($row[1]),
            'lastname'      => trim($row[2]),
            'job_title'     => trim($row[3]),
            'email'         => $email,
            'phone'         => trim($row[5]),
            'company_name'  => trim($row[6]),
            'vat'           => trim($row[7]),
            'url'           => trim($row[8]),
            'company_email' => trim($row[9]),
            'address'       => trim($row[10]),
            'postal'        => trim($row[11]),
            'city'          => trim($row[12]),
            'country'       => trim($row[13]),
        ]);
    } 

    public function batchSize(): int
    {
        return 1000;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function delimiter(): string
    {
        return $this->delimiter;
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => $this->encoding,
            'delimiter' => $this->delimiter,
            'enclosure' => '"',
            'escape_character' => '\\',
            'to_encoding' => 'UTF-8',
        ];
    }
}
