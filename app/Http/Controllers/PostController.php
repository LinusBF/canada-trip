<?php

namespace App\Http\Controllers;

use App\Post;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\LocationExists;

class PostController extends Controller
{

	public function __construct()
	{
		$this->middleware(LocationExists::class, ['only' => ['create']]);
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $posts = Post::all()->sortBy('reference_date');

	    $trip_parts = array();

	    foreach ($posts as $post){

		    array_push($trip_parts, [$post, $post->location]);
	    }

	    return view('posts.index', compact('trip_parts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$locations = Location::all();

	    return view('posts.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

	    $this->validate(request(), ['title' => 'required',
	                                'location' => 'required',
	                                'content' => 'required',
	                                'date' => 'required']);

	    $post_id = Post::create([
		    'title' => request('title'),
		    'content' => request('content'),
		    'location_id' => Location::findOrFail(intval(request('location')))->id,
		    'reference_date' => date(request('date'))])->id;

	    if (request()->hasFile('images')){
		    $this->validate(request(), ['images' => 'required']);

		    $post = Post::findOrFail($post_id);

		    if(!$post->addImage(request('type'))){
		    	Post::destroy($post_id);
		    }
	    }

	    return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
	    $locations = Location::all();

        return view('posts.edit', compact('post', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
	    $this->validate(request(), ['title' => 'required',
	                                'location' => 'required',
	                                'content' => 'required',
	                                'date' => 'required']);

	    $post->update([
		    'title' => request('title'),
		    'content' => request('content'),
		    'location_id' => Location::findOrFail(intval(request('location')))->id,
		    'reference_date' => date(request('date'))]);

	    if (request()->hasFile('images')){
		    $this->validate(request(), ['images' => 'required']);

		    $post->addImage(request('type'));
	    }

	    return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Post::destroy($post->id);

	    foreach ($post->images() as $image){
		    if(Storage::exists($image->path)){
		    	Storage::delete($image->path);
		    }

		    $image->destroy();
	    }

	    return redirect('/home');
    }


	/**
	 *
	 * @param  \App\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function delete_dialog(Post $post)
	{
		return view('posts.delete', compact('post'));
	}
}
