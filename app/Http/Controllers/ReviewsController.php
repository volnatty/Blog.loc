<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function __construct()
    {
        if (!in_array(app('router')->currentRouteName(), ['app.posts.index', 'app.posts.show']) && !auth()->check()) {
            $this->middleware('auth');
        }
    }
    public function index(){
        return view('app.reviews.index');
    }
}
