<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function __construct()
    {
        if (!in_array(app('router')->currentRouteName(), ['app.categories.index', 'app.categories.show']) && !auth()->check()) {
            $this->middleware('auth');
        }
    }

    public function index()
    {
        return view('app.categories.index', [
            'category' => Category::all(),
        ]);
    }

    public function show(Category $category)
    {
        return view('app.categories.show', compact('category'));
    }

    public function create()
    {
        return view('app.categories.create');
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
        ]);

        $category = Category::create(request()->all());

        return redirect()->route('app.categories.show', $category);
    }
}
