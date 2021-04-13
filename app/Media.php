<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Genre;
use App\Collection;

class Media extends Model
{
    protected $primaryKey = "media_id"; //clé primaire
	protected $table = "media"; //nom de la table
    public $timestamps = false;

    /**
     * Attributs de la table.
     *
     * @var array
     */
    protected $fillable = [
        'media_title', 'media_type', 'media_year', 'media_cover', 'media_link'
    ];
	
	/**
	 * Un média peut avoir été créé par plusieurs artistes
	*/
	public function artistes()
	{
		return $this->belongsToMany(Artiste::class,'take_part_in','media_id','human_id');
	}
	
	public function users()
	{
		return $this->belongsToMany(Media::class, 'appreciation', 'media_id', 'human_id');
	}
	
	public function genres()
	{
		return $this->belongsToMany(Genre::class, 'categorized_by', 'media_id', 'genre_id');
	}
	
	public function collections()
	{
		return $this->belongsToMany(Collection::class);
	}
}
