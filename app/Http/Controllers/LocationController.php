<?php

namespace App\Http\Controllers;

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

		    $location->image()->destroy();

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
	    Location::destroy($location->id);

	    if(Storage::exists($location->image->path)){
	    	Storage::delete($location->image->path);
	    }

	    $location->image()->destroy();

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
