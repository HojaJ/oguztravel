<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();

        return view('panel.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('panel.subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name.*' => 'required']);

        Subject::create($request->all());

        return redirect()->route('panel.subjects.index')->with('success', __('Created msg', ['name' => __('Subject')]));
    }

    public function edit(Subject $subject)
    {
        return view('panel.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate(['name.*' => 'required']);

        $subject->update($request->all());

        return redirect()->route('panel.subjects.index')->with('success', __('Updated msg', ['name' => __('Subject')]));
    }

    public function destroy(Subject $subject)
    {
        if (count($subject->messages) == 1) {
            return redirect()->route('panel.subjects.index')->with('warning', __('Attached to', ['name' => __('Subject'), 'thing' => __('Message')]));
        }

        $subject->delete();

        return redirect()->route('panel.subjects.index')->with('danger', __('Deleted msg', ['name' => __('Subject')]));
    }
}
