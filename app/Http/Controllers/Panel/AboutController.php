<?php

namespace App\Http\Controllers\Panel;

use App\Models\About;
use App\Models\AboutImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        About::where('id',1)->update(['page' => 'About Us']);
        $about = About::first();
        return view('panel.about.index', compact('about'));
    }

    public function tours_index()
    {
        $about = About::where('page','Tours')->first();
        return view('panel.about.index', compact('about'));
    }

    public function turkmenistan_index()
    {
        $about = About::where('page','Turkmenistan')->first();
        return view('panel.about.index', compact('about'));
    }

    public function create()
    {
        if (About::count() == 0) {
            return view('panel.about.create');
        }

        return redirect()->route('panel.about.index')->with('warning', __('Exists msg', ['name' => __('About us')]));
    }

    public function store(Request $request)
    {
        if (About::count() == 0) {
            $data = $request->validate([
                'desc.*' => 'required',
                'title.*' => 'required',
                'subtitle.*' => 'required',
                'images.*' => 'required|image|max:1000',
            ]);

            $about = About::create($data);

            foreach ($request->file('images', []) as $key => $image) {
                AboutImage::create([
                    'about_id' => $about->id,
                    'filename' => $this->uploadFile($image, 'about'),
                    'order' => $key + 1,
                ]);
            }

            return redirect()->route('panel.about.index')->with('success', __('Created msg', ['name' => __('About us')]));
        }

        return redirect()->route('panel.about.index')->with('warning', __('About us exists'));
    }

    public function edit(About $about)
    {

        return view('panel.about.edit', compact('about'));
    }

    public function update(About $about, Request $request)
    {
        $data = $request->validate([
            'desc.*' => 'required',
            'title.*' => 'required',
            'subtitle.*' => 'required',
            'file' => 'nullable|image|max:720',
        ]);

        if ($request->has('file')) {
            $this->removeFile($about->filename, 'about');

            $data['filename'] = $this->uploadFile($request->file('file'), 'about');
        }

        $about->update($data);

        $route = '';
        if($about->page == 'About Us'){
            $route = 'panel.about.index';
        }elseif ($about->page == 'Tours'){
            $route = 'panel.tours_index';
        }elseif ($about->page == 'Turkmenistan'){
            $route = 'panel.turkmenistan_index';
        }

        return redirect()->route($route)->with('success', __('Updated msg', ['name' => __($about->page)]));
    }

    public function destroy(About $about)
    {
        foreach ($about->images as $image) {
            $this->removeFile($image->filename, 'about');
            $image->delete();
        }

        $about->delete();
        $route = '';
        if($about->page == 'About Us'){
            $route = 'panel.about.index';
        }elseif ($about->page == 'Tours'){
            $route = 'panel.tours_index';
        }elseif ($about->page == 'Turkmenistan'){
            $route = 'panel.turkmenistan_index';
        }

        return redirect()->route($route)->with('danger', __('Deleted msg', ['name' => __($about->page)]));
    }
}
