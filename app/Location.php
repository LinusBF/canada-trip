<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\Image;

class Location extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'coordinates'
	];

	public function posts()
	{
		return $this->hasMany(Post::class);
	}

	public function image(){
		return $this->hasOne(Image::class);
	}

	public function addImage($type="background")
	{

		$file = request()->file('image');

		$destinationPath = public_path().'/storage/';
		$path = $file->getClientOriginalName();

		$file->move($destinationPath, $path);

		$this->image()->create(compact('path', 'type'));

	}
}
