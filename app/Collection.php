<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Media;

class Collection extends Model
{
    protected $primaryKey = "collect_id";
	protected $table = "collection";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'collect_date_creat', 'collect_title', 'human_id'
    ];
	
	public function medias()
	{
		return $this->belongsToMany(Media::class);
	}
}
