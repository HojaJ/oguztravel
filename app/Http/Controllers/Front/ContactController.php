<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessage;
use App\Models\Contact;
use App\Models\Cover;
use App\Models\Message;
use App\Models\Person;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;


class ContactController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        $cover = Cover::whereSlug('contact')->whereIsActive(true)->first();
        $contacts = Contact::where('type', 'address')->orWhere('type', 'contact')->orWhere('type', 'email')->whereIsActive(true)->get();

        return view('web.contact', compact('contacts', 'cover', 'subjects'));
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $data['phone'] = $request->get('full_number');

        $person_data = [
            'phone' => $data['phone'],
            'email' => $data['email'],
            'name' => $data['name'],
            'surname' => $data['surname']
        ];

        $person = Person::wherePhone($data['phone'])->whereEmail($data['email'])->first();

        try {
            if ($person) {
                $person->update($person_data);
            } else {
                Person::create($person_data);
            }
            Message::create($data);
            $email = Subject::find($data['subject_id'])->email;
            \Mail::to($email)->send(new ContactMessage($data));
            return back()->with('success', __('Your message has been sent'));
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back()->with('danger', __('Something went wrong :('))->withInput();
        }
    }
}
