<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Support\Facades\Hash;

class CustomerImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
                $user =  User::create([
                'name'        => $row['fname'].' '.$row['lname'],
                'email'       => $row['email'],
                'password'    => Hash::make($row['password']),
                'roles'        => $row['roles'],
            ]);
 
            $customer =  Customer::create([
                'title'          =>  $row['title'],
                'fname'          =>  $row['fname'],
                'lname'          =>  $row['lname'],
                'addressline'    =>  $row['addressline'],
                'town'           =>  $row['town'],
                'zipcode'        =>  $row['zipcode'],
                'phone'          =>  $row['phone'],
                'img_path'       => $row['img_path'],
                'user_id'        =>  $user->id,         
            ]);
        }
    }
}