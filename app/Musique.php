<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Musique extends Model
{
    protected $primaryKey = "song_id";
	protected $table = "song";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'song_album', 'song_moment', 'song_path'
    ];
}
