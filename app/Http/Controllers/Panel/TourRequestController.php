<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\TourRequest;
use Illuminate\Http\Request;

class TourRequestController extends Controller
{
    private $kind;

    public function __construct(Request $request)
    {
        $this->setKind($request->get('kind', 'tour'));
    }

    private function setKind($kind)
    {
        if (in_array($kind, ['tour', 'turkmenistan'])) {
            $this->kind = $kind;
        } else {
            $this->kind = 'tour';
        }
    }

    public function index()
    {
        $page_limit = 15;
        $kind = $this->kind;

        $tours = TourRequest::whereType($kind)->latest()->paginate($page_limit);

        return view('panel.tour_requests.index', compact('tours', 'page_limit', 'kind'));
    }

    public function show(TourRequest $tour)
    {
        $tour->is_read = true;
        $tour->save();
        $kind = $this->kind;

        return view('panel.tour_requests.show', compact('tour', 'kind'));
    }

    public function delete(TourRequest $tour)
    {
        $kind = $this->kind;
        $tour->delete();

        return redirect()->route('panel.tour_requests.index', ['kind' => $kind])->with('danger', __('Deleted msg', ['name' => __('Tour request')]));
    }
}
