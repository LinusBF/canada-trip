<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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

		foreach ($files as $file) {
			$destinationPath = public_path() . '/storage/';
			$path = $file->getClientOriginalName();

			$file->move( $destinationPath, $path );

			$this->images()->create( compact( 'path', 'type' ) );
		}
	}
}
