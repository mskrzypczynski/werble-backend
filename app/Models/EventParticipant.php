<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;


/**
 * App\Models\EventParticipant
 *
 * @property int $event_participant_id
 * @property int $is_creator
 * @property int $user_id
 * @property int $event_id
 * @property int $participant_status_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Event $event
 * @property-read \App\Models\EventReview|null $review
 * @property-read \App\Models\ParticipantStatus $status
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|EventParticipant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventParticipant newQuery()
 * @method static \Illuminate\Database\Query\Builder|EventParticipant onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EventParticipant query()
 * @method static \Illuminate\Database\Eloquent\Builder|EventParticipant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventParticipant whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventParticipant whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventParticipant whereEventParticipantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventParticipant whereIsCreator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventParticipant whereParticipantStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventParticipant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventParticipant whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|EventParticipant withTrashed()
 * @method static \Illuminate\Database\Query\Builder|EventParticipant withoutTrashed()
 * @mixin \Eloquent
 */
class EventParticipant extends Model
{
    use HasFactory, SoftDeletes,CascadeSoftDeletes;

    /**
     * The table associated with EventParticipant model
     * @var string
     */
    protected $table = 'event_participants';
    /**
     * The primary key associated with the table
     * @var string
     */
    protected $primaryKey = 'event_participant_id';
    /**
     * Indicates if the IDs are auto-incrementing.     *
     * @var bool
     */
    public $incrementing = true;
    protected  $cascadeDeletes = ['review'];//,'event','user'];

    /* One-to-One Relationships */
    public function review(){
        return $this->hasOne('App\Models\EventReview', 'event_participant_id', 'event_participant_id');
    }
    public function event(){
        return $this->belongsTo('App\Models\Event', 'event_id', 'event_id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User','user_id','user_id');
    }
}
