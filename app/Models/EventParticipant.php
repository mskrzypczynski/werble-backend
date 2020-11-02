<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventParticipant extends Model
{
    use HasFactory, SoftDeletes;

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

    /* One-to-One Relationships */
    public function review()
    {
        return $this->hasOne('App\Models\EventReview', 'event_participant_id', 'event_participant_id');
    }

    public function event()
    {
        return $this->belongsTo('App\Models\Event', 'event_id', 'event_id');
    }

    public function status(){
        return $this->belongsTo('App\Models\ParticipantStatus','participant_status_id','participant_status_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','user_id');
    }
}
