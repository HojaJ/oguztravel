<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourImage;
use Illuminate\Http\Request;

class TourImageController extends Controller
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

    public function create(Tour $tour)
    {
        $type = $this->type;

        return view('panel.tours.images.create', compact('tour', 'type'));
    }

    public function store(Request $request, Tour $tour)
    {
        $request->validate([
            'images.*' => 'required|image|max:1000',
        ]);

        $last_order = 0;

        if ($tour->images()->exists()) {
            $last_order = $tour->images()->orderBy('order', 'desc')->first()->order;
        }

        foreach ($request->file('images', []) as $key => $image) {
            $last_order++;

            TourImage::create([
                'tour_id' => $tour->id,
                'filename' => $this->uploadFile($image, 'tours'),
                'order' => $last_order,
            ]);
        }

        return redirect()->route('panel.tours.show', ['tour' => $tour->id, 'type' => $this->type])->with('success', __('Added msg', ['name' => __('Tour image')]));
    }

    public function destroy(TourImage $image)
    {
        $type = $this->type;
        $tour = $image->tour;

        if (count($tour->images) == 1) {
            return redirect()->route('panel.tours.show', ['tour' => $image->tour->id, 'type' => $type])->with('warning', __('must be at least one thing', ['name' => __('Tour image')]));
        }

        $this->removeFile($image->filename, 'tours');
        $image->delete();

        foreach ($tour->imagesOrderBy() as $key => $item) {
            $item->update(['order' => $key + 1]);
        }

        return redirect()->route('panel.tours.show', ['tour' => $image->tour->id, 'type' => $type])->with('danger', __('Deleted msg', ['name' => __('Tour image')]));
    }

    public function order(Tour $tour)
    {
        $type = $this->type;
        $images = $tour->imagesOrderBy();

        return view('panel.tours.images.order', compact('tour', 'images', 'type'));
    }

    public function orderUpdate(Request $request, Tour $tour)
    {
        foreach ($request->get('ids', []) as $key => $id) {
            TourImage::whereId($id)->update(['order' => $key + 1]);
        }

        return redirect()->route('panel.tours.show', ['tour' => $tour->id, 'type' => $this->type])->with('success', __('Ordered msg', ['name' => __('Tour image')]));
    }
}
