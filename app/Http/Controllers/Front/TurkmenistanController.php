<?php

namespace App\Http\Controllers\Front;

use App\Mail\TourMessage;
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
use Illuminate\Support\Carbon;

class TurkmenistanController extends Controller
{
    public function index(Request $request)
    {
        $min = $request->get('min', null);
        $max = $request->get('max', null);
        $cats = parse_url($request->get('cats', null));

        if($request->get('bound') && in_array($request->get('bound'),['inbound','outbound'])){
            $tours = Tour::whereType('turkmenistan')->where('bound',$request->bound);
            if(isset($min) && isset($max)) {
                $tours = $tours
                    ->where(function ($query) use ($min, $max) {
                        $query->whereNull('discount_active')->whereBetween('price', [$min, $max]);
                    })->orWhere(function ($query) use ($min, $max) {
                        $query->where('discount_active', 1)->whereBetween('discount_price', [$min, $max]);
                    });
            }
            if($cats['path']){
                $tours = $tours->whereIn('category_id',json_decode($cats['path']));
            }
            $tours = $tours->latest()->get();
        }else{
            $tours = null;
        }

        foreach ($tours as $tour){
            if($tour->discount_end_time && Carbon::make($tour->discount_end_time)->isPast()){
                $tour->discount_active = 0;
                $tour->discount_percent = null;
                $tour->discount_end_time = null;
                $tour->discount_price = null;
                $tour->save();
            }
        }
        if($request->ajax()){
            return response()->json(view('web.include.tkm_partial',['tours' => $tours])->render());
        }


        $max_price = Tour::whereType('turkmenistan')->where('bound',$request->bound)->max('price');
        $about = About::where('page','turkmenistan')->first();
        $cover = Cover::whereSlug('turkmenistan')->whereIsActive(true)->first();
        $categories = Category::whereHas('tours', function (Builder $query) {
            $query->whereType('turkmenistan');
        })->get();

        return view('web.turkmenistan.index', compact('tours','about', 'categories', 'cover','max_price'));
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
            'note' => 'nullable',
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
            'date_of_birth' => $request->get('date_of_birth')
        ];

        $person = Person::wherePhone($person_data['phone'])->whereEmail($person_data['email'])->first();

        if ($person) {
            $person->update($person_data);
        } else {
            Person::create($person_data);
        }

        $tour_id =  TourRequest::create($request->all())->id;
        $tour_request = TourRequest::where('id',$tour_id)->with('tour')->first();

        $email = Subject::where('type','Turkmen Tours')->first()->email;
        \Mail::to($email)->send(new TourMessage($tour_request->toArray()));

        return back()->with('success', __('Request has been sent'));
    }
}
