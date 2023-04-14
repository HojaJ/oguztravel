<?php

namespace App\Http\Controllers\Panel;

use App\Models\About;
use App\Models\AboutImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ToursIndexController extends Controller
{
    public function index()
    {
        $about = About::where('page','tours')->first();

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

        return redirect()->route('panel.about.index')->with('success', __('Updated msg', ['name' => __('About us')]));
    }

    public function destroy(About $about)
    {
        foreach ($about->images as $image) {
            $this->removeFile($image->filename, 'about');
            $image->delete();
        }

        $about->delete();

        return redirect()->route('panel.about.index')->with('danger', __('Deleted msg', ['name' => __('About us')]));
    }
}
