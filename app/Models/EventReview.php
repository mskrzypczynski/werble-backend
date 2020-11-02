<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventReview extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with EventReview model
     * @var string
     */
    protected $table = 'event_reviews';

    /**
     * The primary key associated with the table
     * @var string
     */
    protected $primaryKey = 'event_review_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'rating' => 5,
        'is_active' => true,
    ];

    /* One-to-One Relationships */
    public function event()
    {
        return $this->hasOne('App\Models\Event', 'event_id', 'event_id');
    }

    public function participant()
    {
        return $this->belongsTo('App\Models\EventParticipant', 'event_participant_id', 'event_participant_id');
    }
}
