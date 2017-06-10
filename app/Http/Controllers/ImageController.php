<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class ImageController extends Controller
{
	public function store(mixed $item)
	{

		//Add image to either a post or a location object
		$item->addImage(request('type'));

		return true;
	}
}
