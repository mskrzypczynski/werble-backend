<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    /**
     *  Model uses SoftDeletes to not delete records from DB.
     *  Also while deleting we switch entity's is_active attribute to false.
     *  User must verify email
     */
    use HasFactory, Notifiable, HasApiTokens, MustVerifyEmail, SoftDeletes;

    /**
     * The table associated with User model
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key associated with the table
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        #credentials
        'login',
        'email',
        'password',

        #profile
        'first_name',
        'last_name',
        'birth_date',
        'description',

        #localization
        'longitude',
        'latitude',

        #statuses
        'is_admin',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token' //?
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_admin' => false,
        'is_active' => true,
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* One-to-Many Relationships */
    public function events(){
        return $this->hasMany('App\Models\Event','event_creator_id','user_id');
    }

    public function participants(){
        return $this->hasMany('App\Models\EventParticipant','user_id','user_id');
    }

    public function havingFriends(){
        return $this->hasMany('App\Models\UserFriend','friend_id','user_id');
    }

    public function beingFriends(){
        return $this->hasMany('App\Models\UserFriend','user_id','user_id');
}
}
