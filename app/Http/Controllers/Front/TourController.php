<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\TourMessage;
use App\Models\About;
use App\Models\Category;
use App\Models\Cover;
use App\Models\Person;
use App\Models\Subject;
use App\Models\Tour;
use App\Models\TourRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Notification;
use Illuminate\Database\Eloquent\Builder;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $min = $request->get('min', null);
        $max = $request->get('max', null);
        $cats = parse_url($request->get('cats', null));

        $tours = Tour::whereType('tour');
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
            return response()->json(view('web.include.tour_partial',['tours' => $tours])->render());
        }

        $about = About::where('page','tours')->first();
        $max_price = Tour::whereType('tour')->max('price');
        $cover = Cover::whereSlug('tour')->whereIsActive(true)->first();
        $categories = Category::whereHas('tours', function (Builder $query) {
            $query->whereType('tour');
        })->get();

        return view('web.tours.index', compact('about','tours', 'categories', 'cover','max_price'));
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
            'tour' => 'nullable',
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
        $email = Subject::where('type','World Tours')->first()->email;

        \Mail::to($email)->send(new TourMessage($tour_request->toArray()));
        Notification::send(auth()->user(),new \App\Notifications\ServiceRequest($tour_request));

        return back()->with('success', __('Request has been sent'));
    }
}
