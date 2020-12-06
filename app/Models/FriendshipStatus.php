<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\FriendshipStatus
 *
 * @property int $friendship_status_id
 * @property string $friendship_status_name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserFriend[] $friendships
 * @property-read int|null $friendships_count
 * @method static \Illuminate\Database\Eloquent\Builder|FriendshipStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FriendshipStatus newQuery()
 * @method static \Illuminate\Database\Query\Builder|FriendshipStatus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FriendshipStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|FriendshipStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FriendshipStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FriendshipStatus whereFriendshipStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FriendshipStatus whereFriendshipStatusName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FriendshipStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|FriendshipStatus withTrashed()
 * @method static \Illuminate\Database\Query\Builder|FriendshipStatus withoutTrashed()
 * @mixin \Eloquent
 */
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
