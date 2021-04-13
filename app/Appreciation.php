<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appreciation extends Model
{
    protected $primaryKey = "appr_id";
	protected $table = "appreciation";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'appr_note', 'appr_com','appr_date', 'human_id','media_id'
    ];
}
