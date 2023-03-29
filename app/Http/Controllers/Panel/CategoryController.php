<?php

namespace App\Http\Controllers\Panel;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $page_limit = 15;
        $categories = Category::paginate($page_limit);

        return view('panel.categories.index', compact('categories', 'page_limit'));
    }

    public function create()
    {
        return view('panel.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name.*' => 'required'
        ]);

        Category::create($request->all());

        return redirect()->route('panel.categories.index')->with('success', __('Created msg', ['name' => __('Category')]));
    }

    public function edit(Category $category)
    {
        return view('panel.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name.*' => 'required']);
        $category->update($request->only('name'));

        return redirect()->route('panel.categories.index')->with('success', __('Updated msg', ['name' => __('Category')]));
    }

    public function destroy(Category $category)
    {
        // if ($category->tours()->count()) {
        //     return redirect()->route('panel.categories.index')->with('warning', __('Category attach to tours'));
        // }

        $category->delete();

        return redirect()->route('panel.categories.index')->with('danger', __('Deleted msg', ['name' => __('Category')]));
    }
}
