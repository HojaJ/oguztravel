<?php

namespace App\Http\Controllers\Panel;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('order')->get();

        return view('panel.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('panel.banners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title.*' => 'required',
            'subtitle.*' => 'nullable',
            'file' => 'required|image|max:720',
            'link' => 'required|url',
        ]);

        $data['filename'] = $this->uploadFile($request->file('file'), 'banners');

        Banner::create($data);

        return redirect()->route('panel.banners.index')->with('success', __('Created msg', ['name' => __('Banner')]));
    }

    public function edit(Banner $banner)
    {
        return view('panel.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $data = $request->validate([
            'title.*' => 'required',
            'subtitle.*' => 'nullable',
            'file' => 'nullable|image|max:720',
            'link' => 'required|url',
        ]);

        if ($request->has('file')) {
            $this->removeFile($banner->filename, 'banners');

            $data['filename'] = $this->uploadFile($request->file('file'), 'banners');
        }

        $banner->update($data);

        return redirect()->route('panel.banners.index')->with('success', __('Updated msg', ['name' => __('Banner')]));
    }

    public function destroy(Banner $banner)
    {
        $this->removeFile($banner->filename, 'banners');
        $banner->delete();

        return redirect()->route('panel.banners.index')->with('danger', __('Deleted msg', ['name' => __('Banner')]));
    }

    public function orderForm()
    {
        $banners = Banner::orderBy('order')->get();

        if (count($banners) <= 1) {
            return redirect()->route('panel.banners.index')->with('warning', __('must be at least one :thing', ['name' => __('Banner')]));
        }

        return view('panel.banners.order', compact('banners'));
    }

    public function order(Request $request)
    {
        if (Banner::count() <= 1) {
            return redirect()->route('panel.banners.index')->with('warning', __('must be at least one :thing', ['name' => __('Banner')]));
        }

        foreach ($request->get('ids', []) as $key => $id) {
            Banner::whereId($id)->update(['order' => $key + 1]);
        }

        return redirect()->route('panel.banners.index')->with('success', __('Ordered msg', ['name' => __('Banner')]));
    }
}
