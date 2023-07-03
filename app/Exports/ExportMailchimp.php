<?php

namespace App\Exports;

use App\Models\Person;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportMailchimp implements FromView
{
    public function view(): View
    {
        return view('excel.export_mailchimp', [
            'clients' => Person::all()
        ]);
    }
}
