<?php

namespace Teamtnt\SalesManagement\Imports;

use Teamtnt\SalesManagement\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class ContactsImport implements ToModel, WithStartRow, WithBatchInserts
{
    /**
     * @param  array  $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Contact([
            'salutation' => trim($row[0]),
            'firstname' => trim($row[1]),
            'lastname' => trim($row[2]),
            'job_title' => trim($row[3]),
            'email' => trim($row[4]),
            'phone' => trim($row[5])
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function startRow(): int
    {
        return 1;
    }
}
