<?php

namespace App\Http\Controllers\Panel;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    private $contact_lists = ["contact", "address", "copyright"];

    public function index()
    {
        $contact_lists = $this->contact_lists;
        $contacts = Contact::orderByRaw("FIELD(type, \"phone\", \"email\", \"address\", \"copyright\", \"social\")")->get();

        return view('panel.contact.index', compact('contacts', 'contact_lists'));
    }

    public function create()
    {
        return view('panel.contact.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => 'required|unique:contacts,slug',
            'icon' => 'nullable',
            'data' => 'required|url',
            'is_active' => 'nullable',
        ]);

        $data['type'] = 'social';

        Contact::create($data);

        return redirect()->route('panel.contact.index')->with('success', __('Created msg', ['name' => __('Social network link')]));
    }

    public function edit(Contact $contact, Request $request)
    {
        return view('panel.contact.edit', compact('contact'));
    }

    public function update(Contact $contact, Request $request)
    {
        $data = $request->validate([
            'icon' => 'nullable',
            'data' => 'nullable',
            'locale_data.*' => 'nullable',
            'is_active' => 'nullable',
        ]);

        if (!$request->has('is_active') && $contact->is_active) {
            $data['is_active'] = false;
        }
        if(isset($data['locale_data'])){
            $data['locale_data'] = array_map('strip_tags',$data['locale_data']);
        }

        if(!isset($data['data'])){
            $data['data'] = null;
        }

        $contact->update($data);
        return redirect()->route('panel.contact.index')->with('success', __('Updated msg', ['name' => __('Contact us')]));
    }

    public function destroy(Contact $contact)
    {
        if (in_array($contact->type, $this->contact_lists)) {
            return redirect()->route('panel.contact.index')->with('warning', __('Can not delete this contact'));
        }

        $contact->delete();

        return redirect()->route('panel.contact.index')->with('danger', __('Deleted msg', ['name' => __('Contact us')]));
    }
}
