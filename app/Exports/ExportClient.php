<?php

namespace App\Exports;

use App\Models\Person;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportClient implements FromView
{
    public function view(): View
    {
        return view('excel.export_clients', [
            'clients' => Person::all()
        ]);
    }
}
