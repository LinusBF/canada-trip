<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Location;
use App\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$locations = Location::all();
	    $posts = Post::all();

    	$loc_count = count($locations);

        return view('home', compact('loc_count', 'locations', 'posts'));
    }

    public function show(){
    	$image = Image::where('type', 'start_page');

	    if (isset($image)){
	    	$image = $image->first();
	    }

    	return view('welcome', compact('image'));
    }
}
