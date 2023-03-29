<?php

namespace App\Http\Controllers\Panel;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return view('panel.services.index', compact('services'));
    }

    public function edit(Service $service)
    {
        return view('panel.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title.*' => 'required',
            'subtitle.*' => 'required',
            'is_active' => 'nullable',
            'file' => 'nullable|image|max:720',
        ]);

        if ($request->has('file')) {
            $this->removeFile($service->filename, 'services');

            $data['filename'] = $this->uploadFile($request->file('file'), 'services');
        }

        if (!$request->has('is_active') && $service->is_active) {
            $data['is_active'] = false;
        }

        $service->update($data);

        return redirect()->route('panel.services.index')->with('success', __('Updated msg', ['name' => __('Service')]));
    }
}
