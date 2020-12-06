<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\UserFriend
 *
 * @property int $friendship_id
 * @property int $user_id
 * @property int $friend_id
 * @property int $friendship_status_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $beingFriend
 * @property-read \App\Models\User $beingUser
 * @property-read \App\Models\FriendshipStatus $status
 * @method static \Illuminate\Database\Eloquent\Builder|UserFriend newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFriend newQuery()
 * @method static \Illuminate\Database\Query\Builder|UserFriend onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFriend query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFriend whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFriend whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFriend whereFriendId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFriend whereFriendshipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFriend whereFriendshipStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFriend whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFriend whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|UserFriend withTrashed()
 * @method static \Illuminate\Database\Query\Builder|UserFriend withoutTrashed()
 * @mixin \Eloquent
 */
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
