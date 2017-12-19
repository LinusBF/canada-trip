<?php

namespace App\Http\Controllers;

use App\Image;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::all();

	    $trip_parts = array();

	    foreach ($locations as $location){

	    	array_push($trip_parts, [$location, $location->posts]);
	    }

	    return view('locations.index', compact('trip_parts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $this->validate(request(), ['name' => 'required', 'coordinates' => 'required']);

	    $location_id = Location::create([
	    	'name' => request('name'),
		    'coordinates' => request('coordinates')])->id;

	    if (request()->hasFile('image')){
		    $this->validate(request(), ['image' => 'required']);

		    $location = Location::findOrFail($location_id);

		    $location->addImage(request('type'));
	    }

	    return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
	    return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
	    $this->validate(request(), ['name' => 'required',
	                                'coords' => 'required']);

	    $location->update([
		    'name' => request('name'),
		    'coordinates' => request('coords')]);

	    if (request()->hasFile('image')){
		    if(Storage::exists($location->image->path)){
			    Storage::delete($location->image->path);
		    }

		    Image::destroy($location->image->id);

		    $this->validate(request(), ['image' => 'required']);

		    $location->addImage(request('type'));
	    }

	    return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
	    if(Storage::exists($location->image->path)){
	    	Storage::delete($location->image->path);
	    }

	    Image::destroy($location->image->id);

	    Location::destroy($location->id);

	    return redirect('/home');
    }

	/**
	 *
	 * @param  \App\Location  $location
	 * @return \Illuminate\Http\Response
	 */
	public function delete_dialog(Location $location)
	{
		return view('locations.delete', compact('location'));
	}

}
