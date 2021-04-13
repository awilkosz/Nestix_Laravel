<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Media;

class User extends Authenticatable
{
    use Notifiable;
	protected $table = 'users';
	protected $primaryKey = 'human_id';
	public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_pseudo', 'email', 'user_status', 'password', 'user_date_creat', 'city_id', 'reinitialiser'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	public function medias()
	{
		return $this->belongsToMany(Media::class, 'appreciation', 'human_id', 'media_id');
	}
}
