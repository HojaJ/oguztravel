<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Banner;
use App\Models\Cover;
use App\Models\Tour;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        $about = About::first();
        $banners = Banner::orderBy('order')->get();
        $cover_service = Cover::whereSlug('service')->whereIsActive(true)->first();
        $cover_tour = Cover::whereSlug('tour')->whereIsActive(true)->first();
        $cover_turkmenistan = Cover::whereSlug('turkmenistan')->whereIsActive(true)->first();
        $tours = Tour::whereType('tour')->inRandomOrder()->limit(4)->get();
        $turkmenistan = Tour::whereType('turkmenistan')->inRandomOrder()->limit(4)->get();
        $toursCount = Tour::whereType('tour')->count();
        $tmCount = Tour::whereType('turkmenistan')->count();

        return view('web.index', compact('banners', 'about', 'cover_service', 'tours', 'turkmenistan', 'toursCount', 'tmCount', 'cover_tour', 'cover_turkmenistan'));
    }

    public function about()
    {
        $about = About::first();
        $cover = Cover::whereSlug('about')->whereIsActive(true)->first();
        
        return view('web.about', compact('cover', 'about'));
    }

    public function privacy()
    {
        $about = About::where('page','Privacy')->first();
        $cover = Cover::whereSlug('about')->whereIsActive(true)->first();
        return view('web.privacy', compact('about','cover'));

    }
}
