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

        return redirect()->route('panel.about.index')->with('success', __('Added msg', ['name' => __('About image')]));
    }

    public function destroy(AboutImage $image)
    {
        $about = $image->about;

        if (count($about->images) == 1) {
            return redirect()->route('panel.about.index')->with('warning', __('must be at least one thing', ['name' => __('About image')]));
        }

        $this->removeFile($image->filename, 'about');
        $image->delete();

        foreach ($about->imagesOrderBy() as $key => $item) {
            $item->update(['order' => $key + 1]);
        }

        return redirect()->route('panel.about.index')->with('danger', __('Deleted msg', ['name' => __('About image')]));
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

        return redirect()->route('panel.about.index')->with('success', __('Ordered msg', ['name' => __('About image')]));
    }
}
