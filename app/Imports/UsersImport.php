<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
   
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row[0])) {
            return null;
        }
        return new User([
            'name' => $row[0],
            'email' => $row[1],
            'phone' => $row[2],
            'role_id' => $row[3],
        ]);
    }
}
