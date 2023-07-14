<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AboutImage;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index()
    {
        $about = About::where('page','Privacy')->first();

        return view('panel.privacy.index', compact('about'));
    }


    public function edit(About $privacy)
    {

        return view('panel.privacy.edit', compact('privacy'));
    }

    public function update(About $privacy, Request $request)
    {
        $data = $request->validate([
            'desc.*' => 'required',
            'title.*' => 'required',
            'subtitle.*' => 'required',
        ]);;
        $privacy->update($data);
        return redirect()->route('panel.privacy.index')->with('success', __('Updated msg', ['name' => __($privacy->page)]));
    }
}
