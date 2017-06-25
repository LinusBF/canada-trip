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
		$media_type = request('media_type');

		if(Image::where('type', 'start_page')->first() !== null){
			$start_page = Image::where('type', 'start_page')->first();
			Storage::delete($start_page->path);
			Image::destroy($start_page->id);
		}

		if($media_type == "image") {
			$path = request()->file( 'media' )->storeAs(
				'public', 'bg_start.' . request()->file( 'media' )->extension()
			);

			Storage::setVisibility( $path, 'public' );
		}else{
			$link = request('media_link');
			//Get the Youtube video ID out of the URL and save it as the video path
			parse_str(parse_url($link)['query'], $parsed_link);
			$path = $parsed_link['v'];
		}
		Image::create(compact('path', 'type'));

		return redirect('/home');
	}

}
