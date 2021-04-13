<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artiste extends Model
{
    protected $primaryKey = "human_id";
	protected $table = "artist";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'artist_dod', 'artist_nickname'
    ];
	
	public function medias()
	{
		return $this->belongsToMany(Media::class,'take_part_in','human_id','media_id');
	}
}
