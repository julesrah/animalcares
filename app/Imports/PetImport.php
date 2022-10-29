<?php

namespace App\Imports;

use App\Models\Pets;
use Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PetImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            $pet = new Pets();
            $pet->name = $row['name'];
            $pet->type = $row['type'];
            $pet->breed = $row['breed'];
            $pet->img_path = $row['img_path'];
            $pet->customer_id = Auth::user()->id;

            $pet->save();
        }
    }
}