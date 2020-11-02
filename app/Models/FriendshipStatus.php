<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FriendshipStatus extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The table associated with FriendshipStatus model
     * @var string
     */
    protected $table = 'friendship_statuses';

    /**
     * The primary key associated with the table
     * @var string
     */
    protected $primaryKey = 'friendship_status_id';

    /**
     * Indicates if the IDs are auto-incrementing.  *
     * @var bool
     */
    public $incrementing = true;


    /* One-to-Many Relationships */
    public function friendships()
    {
        return $this->hasMany('App\Models\UserFriend', 'friendship_status_id', 'friendship_status_id');
    }

}
