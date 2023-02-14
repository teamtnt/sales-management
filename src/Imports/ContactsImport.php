<?php

namespace Teamtnt\SalesManagement\Imports;

use Teamtnt\SalesManagement\Models\ContactTemp;
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
        return new ContactTemp([
            'salutation'    => trim($row[0]),
            'firstname'     => trim($row[1]),
            'lastname'      => trim($row[2]),
            'job_title'     => trim($row[3]),
            'email'         => trim($row[4]),
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
        return 1;
    }
}
