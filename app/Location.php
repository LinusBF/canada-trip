<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\Image;
use Illuminate\Support\Facades\Storage;

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

		$path = request()->file('image')->store('public');
		Storage::setVisibility($path, 'public');

		$this->image()->create(compact('path', 'type'));

	}
}
