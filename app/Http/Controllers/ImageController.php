<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
	public function store(mixed $item)
	{

		//Add image to either a post or a location object
		$item->addImage(request('type'));

		return true;
	}

	public function start_page(){
		return view('set_start_page');
	}

	public function store_start_page(Request $request){
		$type = request('type');

		if(Image::where('type', 'start_page')->first() !== null){
			$start_page = Image::where('type', 'start_page')->first();
			Storage::delete($start_page->path);
			Image::destroy($start_page->id);
		}

		$path = request()->file('media')->storeAs(
			'public', 'bg_start.'.request()->file('media')->extension()
		);

		Image::create(compact('path', 'type'));

		return redirect('/home');
	}

}
