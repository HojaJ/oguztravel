<?php

namespace App\Http\Controllers\Panel;

use App\Exports\ExportClient;
use App\Exports\ExportMailchimp;
use App\Http\Controllers\Controller;
use App\Imports\ImportClient;
use App\Models\Person;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ClientController extends Controller
{
    public function index(Request $request)
    {
        $page_limit = 30;
        $q = $request->get('q', null);
        if ($q) {
            $clients = Person::latest()->where(function ($query) use ($q){
                $query->where('name', 'like', '%' . $q . '%')
                    ->orWhere('surname', 'like', '%' . $q . '%')
                    ->orWhere('patronymic', 'like', '%' . $q . '%')
                    ->orWhere('email', 'like', '%' . $q . '%')
                    ->orWhere('phone', 'like', '%' . $q . '%')
                    ->orWhere('gender', 'like', '%' . $q . '%');
            })->paginate($page_limit);
        } else {
            $clients = Person::latest()->paginate($page_limit);
        }
        return view('panel.clients.index', compact('clients', 'page_limit', 'q'));
    }

    public function create()
    {
        return view('panel.clients.create');
    }

    public function store(Request $request)
    {
        Person::create($request->all());

        return redirect()->route('panel.clients.index')->with('success', __('Created msg', ['name' => __('Client')]));
    }

    public function edit(Person $client)
    {
        return view('panel.clients.edit', compact('client'));
    }

    public function update(Request $request, Person $client)
    {
        $client->update($request->all());

        return redirect()->route('panel.clients.index')->with('success', __('Updated msg', ['name' => __('Client')]));
    }


    public function destroy(Person $client)
    {
        $client->delete();
        return redirect()->route('panel.clients.index')->with('danger', __('Deleted msg', ['name' => __('Client')]));
    }

    public function exportClients(Request $request)
    {
        return Excel::download(new ExportClient,'clients.xlsx');
    }

    public function exportMailchimp(Request $request)
    {
        return Excel::download(new ExportMailchimp(),'mailchimp.xlsx');
    }

    public function importClients(Request $request)
    {
        Excel::import(new ImportClient, $request->file('file')->store('files'));
        return redirect()->back()->with('success', __('New Clients Added'));
    }
}
