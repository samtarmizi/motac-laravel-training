<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // call api https://jsonplaceholder.typicode.com/posts

        $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        if($response->ok()) {
            $posts = $response->object();
        } else {
            $posts = [];
        }

        // resources/views/home.blade.php
        return view('home', compact('posts'));
    }
}
