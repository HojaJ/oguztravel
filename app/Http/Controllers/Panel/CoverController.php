<?php

namespace App\Http\Controllers\Panel;

use App\Models\Cover;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoverController extends Controller
{
    public function index()
    {
        $covers = Cover::all();

        return view('panel.covers.index', compact('covers'));
    }

    public function edit(Cover $cover)
    {
        return view('panel.covers.edit', compact('cover'));
    }

    public function update(Request $request, Cover $cover)
    {
        $data = $request->validate([
            'subtitle.*' => 'nullable',
            'is_active' => 'nullable',
            'file' => 'nullable|image|max:720',
        ]);

        if ($request->has('file')) {
            $this->removeFile($cover->filename, 'covers');

            $data['filename'] = $this->uploadFile($request->file('file'), 'covers');
        }

        if (!$request->has('is_active') && $cover->is_active) {
            $data['is_active'] = false;
        }

        $cover->update($data);

        return redirect()->route('panel.covers.index')->with('success', __('Updated msg', ['name' => __('cover')]));
    }
}
