<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $page_limit = 30;
        $q = $request->get('q', null);

        if ($q) {
            $countries = Country::where('name', 'like', "%{$q}%")->paginate($page_limit);
        } else {
            $countries = Country::paginate($page_limit);
        }

        return view('panel.countries.index', compact('countries', 'page_limit', 'q'));
    }

    public function create()
    {
        return view('panel.countries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name.*' => 'required',
            'is_active' => 'nullable'
        ]);

        Country::create($request->all());

        return redirect()->route('panel.countries.index')->with('success', __('Created msg', ['name' => __('Country')]));
    }

    public function edit(Country $country)
    {
        return view('panel.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $data = $request->validate([
            'name.*' => 'required',
            'is_active' => 'nullable'
        ]);

        if (!$request->has('is_active') && $country->is_active) {
            $data['is_active'] = false;
        }

        $country->update($data);

        return redirect()->route('panel.countries.index')->with('success', __('Updated msg', ['name' => __('Country')]));
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->route('panel.countries.index')->with('danger', __('Deleted msg', ['name' => __('Country')]));
    }
}
