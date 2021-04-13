<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $primaryKey = "genre_id";
	protected $table = "genre";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'genre_name'
    ];
	
	public function medias()
	{
		return $this->belongsToMany(Media::class, 'categorized_by', 'genre_id', 'media_id');
	}
}
