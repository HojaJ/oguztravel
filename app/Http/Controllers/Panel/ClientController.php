<?php

namespace App\Http\Controllers\Panel;

use App\Exports\ExportClient;
use App\Http\Controllers\Controller;
use App\Imports\ImportClient;
use App\Models\Person;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ClientController extends Controller
{
    public function index()
    {
        $page_limit = 15;
        $clients = Person::latest()->paginate($page_limit);
        return view('panel.clients.index', compact('clients', 'page_limit'));
    }

    public function exportClients(Request $request)
    {
        return Excel::download(new ExportClient,'clients.xlsx');
    }

    public function importClients(Request $request)
    {
        Excel::import(new ImportClient, $request->file('file')->store('files'));
        return redirect()->back()->with('success', __('New Clients Added'));
    }
}
