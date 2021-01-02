<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\EventReview
 *
 * @property int $event_review_id
 * @property string|null $content
 * @property int|null $rating
 * @property string $datetime
 * @property int $is_active
 * @property int $event_participant_id
 * @property int $event_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Event|null $event
 * @property-read \App\Models\EventParticipant $participant
 * @method static \Illuminate\Database\Eloquent\Builder|EventReview newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventReview newQuery()
 * @method static \Illuminate\Database\Query\Builder|EventReview onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EventReview query()
 * @method static \Illuminate\Database\Eloquent\Builder|EventReview whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventReview whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventReview whereDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventReview whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventReview whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventReview whereEventParticipantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventReview whereEventReviewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventReview whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventReview whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventReview whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|EventReview withTrashed()
 * @method static \Illuminate\Database\Query\Builder|EventReview withoutTrashed()
 * @mixin \Eloquent
 */
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

    protected $fillable = [
        'content',
        'rating'
        ];

    /* One-to-One Relationships */
    public function participant()
    {
        return $this->belongsTo('App\Models\EventParticipant', 'event_participant_id', 'event_participant_id');
    }
}
