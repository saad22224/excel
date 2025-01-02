<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        $email = User::where('email' , $row[1])->first();
        if($email) {
            return session()->flash('secondError' , 'something went wrong' . $row[1] . 'already exists');
            return null;
        }
        return new User([
           'name' => $row[0],
           'email' => $row[1],
           'password' => Hash::make($row[2]),
        ]);
    }
}
