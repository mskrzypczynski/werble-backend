<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserFriend extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with UserFriend model
     * @var string
     */
    protected $table = 'user_friends';

    /**
     * The primary key associated with the table
     * @var string
     */
    protected $primaryKey = 'friendship_id';

    /**
     * Indicates if the IDs are auto-incrementing.     *
     * @var bool
     */
    public $incrementing = true;


    /* Relationships */
    public function status()
    {
        return $this->belongsTo('App\Models\FriendshipStatus', 'friendship_status_id', 'friendship_status_id');
    }

    public function beingFriend()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'friend_id');
    }

    public function beingUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }
}
