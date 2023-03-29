<?php

namespace App\Http\Controllers\Front;

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
    public function index()
    {
        $tours = Tour::whereType('turkmenistan')->latest()->get();
        $cover = Cover::whereSlug('turkmenistan')->whereIsActive(true)->first();

        $categories = Category::whereHas('tours', function (Builder $query) {
            $query->whereType('turkmenistan');
        })->get();

        return view('web.turkmenistan.index', compact('tours', 'categories', 'cover'));
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
            'phone' => 'required',
            'date_of_birth' => 'required',
            'applicant_type' => 'required|in:inbound,outbound',
            'scanned_passport' => 'nullable|mimes:jpg,bmp,png,docx,pdf'
        ]);

        $request->merge([
            'type' => 'turkmenistan',
            'date_of_birth' => date('Y-m-d', strtotime($request->get('date_of_birth')))
        ]);

        $file = $request->file('scanned_passport');

        if ($file) {
            $request->merge([
                'file_type' => $file->extension(),
                'filename' => $this->uploadFile($file, 'tour_requests'),
            ]);
        }

        $person_data = [
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'patronymic' => $request->get('patronymic'),
            'date_if_birth' => $request->get('date_of_birth')
        ];

        $person = Person::wherePhone($person_data['phone'])->whereEmail($person_data['email'])->first();

        if ($person) {
            $person->update($person_data);
        } else {
            Person::create($person_data);
        }

        TourRequest::create($request->all());

        return back()->with('success', __('Request has been sent'));
    }
}
