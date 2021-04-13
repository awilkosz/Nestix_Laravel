<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//https://stackoverflow.com/questions/31415213/how-i-can-put-composite-keys-in-models-in-laravel-5

class Contains extends Model
{
    //protected $primaryKey = array('media_id', 'collect_id');
	protected $table = 'contains';
	public $timestamps = false;
	
	protected $fillable = [
        'media_id', 'collect_id',
    ];
}
