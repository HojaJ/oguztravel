<?php

namespace App\Imports;

use App\Models\Person;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportClient implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            if ($row[0] === 'Name')continue;
            Person::updateOrCreate([
                'email' => $row[3],
                'phone' => $row[4],
            ],[
                'name'  =>  $row[0],
                'surname' => $row[1],
                'patronymic' => $row[2],
                'email' => $row[3],
                'phone' => $row[4],
                'gender' => $row[5],
                'date_of_birth' => $row[6],
                'lang' => $row[7],
            ]);
        }
    }
}
