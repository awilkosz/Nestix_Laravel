<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Humain extends Model
{
    protected $primaryKey = "human_id";
	protected $table = "human";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'human_lastname', 'human_firstname', 'human_sex', 'human_dob', 'human_pic'
    ];
}
