<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livre extends Model
{
    protected $primaryKey = "book_id";
	protected $table = "book";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ISBN', 'book_synop', 'book_tome', 'book_saga'
    ];
}
