<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\TranslationMessage;
use App\Models\About;
use App\Models\Category;
use App\Models\Cover;
use App\Models\Person;
use App\Models\Subject;
use App\Models\Tour;
use App\Models\TourRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class TourController extends Controller
{
    public function index()
    {
        $about = About::where('page','tours')->first();
        $tours = Tour::whereType('tour')->latest()->get();
        $cover = Cover::whereSlug('tour')->whereIsActive(true)->first();

        $categories = Category::whereHas('tours', function (Builder $query) {
            $query->whereType('tour');
        })->get();

        return view('web.tours.index', compact('about','tours', 'categories', 'cover'));
    }

    public function show(Tour $tour)
    {
        return view('web.tours.show', compact('tour'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'patronymic' => 'nullable',
            'email' => 'required|email',
            'phone' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'scanned_passport' => 'nullable',
            'tour_id' => 'required|exists:tours,id',
        ]);

        $request->merge([
            'type' => 'tour',
            'date_of_birth' => date('Y-m-d', strtotime($request->get('date_of_birth')))
        ]);

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
            'patronymic' => $request->get('patronymic'),
            'gender' => $request->get('gender'),
            'date_if_birth' => $request->get('date_of_birth')
        ];

        $person = Person::wherePhone($person_data['phone'])->whereEmail($person_data['email'])->first();

        if ($person) {
            $person->update($person_data);
        } else {
            Person::create($person_data);
        }
        $email = Subject::where('type','World Tours')->first()->email;
        \Mail::to($email)->send(new TranslationMessage($request->all()));
        TourRequest::create($request->all());
        return back()->with('success', __('Request has been sent'));
    }
}
