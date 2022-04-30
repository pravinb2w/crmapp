<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ImportCustomer implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        return new Customer([
            'first_name' => $row[0],
            'last_name' => $row[1],
            'dob' =>  $this->transformDate($row[2]),
            'email' => $row[3],
            'mobile_no' => $row[4],
            'status' => 1,
            'added_by' => Auth::id(),
        ]);
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
}
