<?php

namespace App\Imports;

use App\Candidate;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UserImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        return new Candidate([
            'name' => $row['name'],
            'email' => $row['email'],
            'phone_number' => $row['phone_number'],
        ]);
    }


}
