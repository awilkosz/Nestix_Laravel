<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $primaryKey = "movie_id";
	protected $table = "movie";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'visa', 'movie_runtime', 'movie_trailer', 'movie_synop', 'movie_budget', 'movie_saga'
    ];
}
