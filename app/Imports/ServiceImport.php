<?php

namespace App\Imports;

use App\Models\Services;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ServiceImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            $service = new Services();
            $service->description = $row['description'];
            $service->price = $row['price'];
            $service->img_path = $row['img_path'];

            $service->save();
        }
    }
}