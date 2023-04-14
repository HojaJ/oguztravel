<?php

namespace App\Http\Controllers\Panel;

use App\Models\About;
use App\Models\AboutImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutImageController extends Controller
{
    public function create(About $about)
    {
        return view('panel.about.images.create', compact('about'));
    }

    public function store(Request $request, About $about)
    {
        $request->validate([
            'images.*' => 'required|image|max:1000',
        ]);

        $last_order = 0;

        if ($about->images()->exists()) {
            $last_order = $about->images()->orderBy('order', 'desc')->first()->order;
        }

        foreach ($request->file('images', []) as $key => $image) {
            $last_order++;
            AboutImage::create([
                'about_id' => $about->id,
                'filename' => $this->uploadFile($image, 'about'),
                'order' => $last_order,
            ]);
        }

        $route = '';
        if($about->page == 'About Us'){
            $route = 'panel.about.index';
        }elseif ($about->page == 'Tours'){
            $route = 'panel.tours_index';
        }elseif ($about->page == 'Turkmenistan'){
            $route = 'panel.turkmenistan_index';
        }
        return redirect()->route($route)->with('success', __('Added msg', ['name' => __($about->page)]));
    }

    public function destroy(AboutImage $image)
    {
        $about = $image->about;
        $route = '';
        if($about->page == 'About Us'){
            $route = 'panel.about.index';
        }elseif ($about->page == 'Tours'){
            $route = 'panel.tours_index';
        }elseif ($about->page == 'Turkmenistan'){
            $route = 'panel.turkmenistan_index';
        }
        if (count($about->images) == 1) {
            return redirect()->route($route)->with('warning', __('must be at least one thing', ['name' => __($about->page)]));
        }

        $this->removeFile($image->filename, 'about');
        $image->delete();

        foreach ($about->imagesOrderBy() as $key => $item) {
            $item->update(['order' => $key + 1]);
        }

        return redirect()->route($route)->with('danger', __('Deleted msg', ['name' => __($about->page)]));
    }

    public function order(About $about)
    {
        $images = $about->imagesOrderBy();

        return view('panel.about.images.order', compact('about', 'images'));
    }

    public function orderUpdate(Request $request, About $about)
    {
        foreach ($request->get('ids', []) as $key => $id) {
            AboutImage::whereId($id)->update(['order' => $key + 1]);
        }

        $route = '';
        if($about->page == 'About Us'){
            $route = 'panel.about.index';
        }elseif ($about->page == 'Tours'){
            $route = 'panel.tours_index';
        }elseif ($about->page == 'Turkmenistan'){
            $route = 'panel.turkmenistan_index';
        }
        return redirect()->route($route)->with('success', __('Ordered msg', ['name' => __($about->page)]));
    }
}
