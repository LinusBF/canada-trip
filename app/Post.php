<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Image;
use App\Location;

class Post extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title', 'content', 'reference_date', 'location_id'
	];

	public function location(){
		return $this->belongsTo(Location::class);
	}

	public function images()
	{
		return $this->hasMany(Image::class);
	}

	public function addImage($type="gallery")
	{

		$files = request()->file('images');

		$lastImagePath = "";

		foreach ($files as $file) {
			$path = $file->store('public');

			$this->images()->create(compact('path', 'type'));

			$lastImagePath = $path;
		}

		return Storage::exists($lastImagePath);
	}
}
