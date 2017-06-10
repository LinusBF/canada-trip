<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\Location;

class Image extends Model
{

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'path', 'type'
	];

	public function post()
	{
		return $this->belongsTo(Post::class);
	}

	public function image(){
		return $this->belongsTo(Location::class);
	}
}
