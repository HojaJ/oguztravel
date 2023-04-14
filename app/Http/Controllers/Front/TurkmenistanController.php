<?php

namespace App\Http\Controllers\Front;

use App\Mail\HotelMessage;
use App\Mail\TicketMessage;
use App\Mail\TranslationMessage;
use App\Mail\VisaMessage;
use App\Models\About;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Cover;
use App\Models\Person;
use App\Models\Tour;
use App\Models\TourRequest;
use Illuminate\Database\Eloquent\Builder;

class TurkmenistanController extends Controller
{
    public function index(Request $request)
    {
        $about = About::where('page','turkmenistan')->first();
        if($request->bound && in_array($request->bound,['inbound','outbound'])){
            $tours = Tour::whereType('turkmenistan')->where('bound',$request->bound)->latest()->get();
        }else{
            $tours = null;
        }
        $cover = Cover::whereSlug('turkmenistan')->whereIsActive(true)->first();
        $categories = Category::whereHas('tours', function (Builder $query) {
            $query->whereType('turkmenistan');
        })->get();

        return view('web.turkmenistan.index', compact('tours','about', 'categories', 'cover'));
    }

    public function show(Tour $tour)
    {
        return view('web.turkmenistan.show', compact('tour'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'patronymic' => 'nullable',
            'email' => 'required|email',
            'gender' => 'required',
            'phone' => 'required',
            'date_of_birth' => 'required',
            'scanned_passport' => 'nullable'
        ]);

        $request->merge([
            'type' => 'turkmenistan',
            'date_of_birth' => date('Y-m-d', strtotime($request->get('date_of_birth')))
        ]);

//        $file = $request->file('scanned_passport');

        $scanned_files_array = [];
        $scanned_passport_file = $request->file('scanned_passport');
        if ($scanned_passport_file) {
            $filename = [];
            foreach ($request->file('scanned_passport', []) as $key => $file) {
                $filename['file_type'] = $file->extension();
                $filename['filename'] = $this->uploadFile($file,'scanned_passport_file');
                $scanned_files_array[] = $filename;
            }
        }

        if ($scanned_files_array) {
            $request->merge([
                'filename' => json_encode($scanned_files_array),
            ]);
        }


        $person_data = [
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'gender' => $request->get('gender'),
            'patronymic' => $request->get('patronymic'),
            'date_if_birth' => $request->get('date_of_birth')
        ];

        $person = Person::wherePhone($person_data['phone'])->whereEmail($person_data['email'])->first();

        if ($person) {
            $person->update($person_data);
        } else {
            Person::create($person_data);
        }
        $email = Subject::where('type','Turkmen Tours')->first()->email;
        \Mail::to($email)->send(new TranslationMessage($request->all()));

        TourRequest::create($request->all());

        return back()->with('success', __('Request has been sent'));
    }
}
