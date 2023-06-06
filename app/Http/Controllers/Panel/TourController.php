<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tour;
use App\Models\TourImage;
use Illuminate\Http\Request;

class TourController extends Controller
{
    private $type;

    public function __construct(Request $request)
    {
        $this->setType($request->get('type', 'tour'));
    }

    private function setType($type)
    {
        if (in_array($type, ['tour', 'turkmenistan'])) {
            $this->type = $type;
        } else {
            $this->type = 'tour';
        }
    }

    public function index()
    {
        $page_limit = 15;
        $type = $this->type;


        $tours = Tour::whereType($type)->latest()->paginate($page_limit);

        return view('panel.tours.index', compact('tours', 'page_limit', 'type'));
    }

    public function create()
    {
        $type = $this->type;
        $categories = Category::all();

        return view('panel.tours.create', compact('categories', 'type'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title.*' => 'required',
            'description.*' => 'required',
            'include.*' => 'required',
            'details.*' => 'required',
            'bound' => 'nullable',
            'price' => 'nullable',
            'images.*' => 'image|max:1000|required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $type = $this->type;
        $data['type'] = $type;
        $tour = Tour::create($data);

        foreach ($request->file('images', []) as $key => $image) {
            TourImage::create([
                'tour_id' => $tour->id,
                'filename' => $this->uploadFile($image, 'tours'),
                'order' => $key + 1,
            ]);
        }

        return redirect()->route('panel.tours.index', ['type' => $type])->with('success', __('Created msg', ['name' => __('Tour')]));
    }

    public function show(Tour $tour)
    {
        $type = $this->type;

        return view('panel.tours.show', compact('tour', 'type'));
    }

    public function edit(Tour $tour)
    {
        $type = $this->type;
        $categories = Category::all();

        return view('panel.tours.edit', compact('tour', 'categories', 'type'));
    }

    public function update(Tour $tour, Request $request)
    {
        $data = $request->validate([
            'title.*' => 'required',
            'description.*' => 'required',
            'include.*' => 'required',
            'details.*' => 'required',
            'bound' => 'nullable',
            'price' => 'nullable',
            'category_id' => 'required|exists:categories,id',
        ]);

        $type = $this->type;
        $data['type'] = $type;
        $tour->update($data);

        return redirect()->route('panel.tours.index', ['type' => $type])->with('success', __('Updated msg', ['name' => __('Tour')]));
    }

    public function destroy(Tour $tour)
    {
        $type = $this->type;

        foreach ($tour->images as $image) {
            $this->removeFile($image->filename, 'tours');
            $image->delete();
        }

        $tour->delete();

        return redirect()->route('panel.tours.index', ['type' => $type])->with('danger', __('Deleted msg', ['name' => __('Tour')]));
    }
}
