<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ParticipantStatus
 *
 * @property int $participant_status_id
 * @property string $participant_status_name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventParticipant[] $participants
 * @property-read int|null $participants_count
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipantStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipantStatus newQuery()
 * @method static \Illuminate\Database\Query\Builder|ParticipantStatus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipantStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipantStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipantStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipantStatus whereParticipantStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipantStatus whereParticipantStatusName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParticipantStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ParticipantStatus withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ParticipantStatus withoutTrashed()
 * @mixin \Eloquent
 */
class ParticipantStatus extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The table associated with ParticipantStatus model
     * @var string
     */
    protected $table = 'participant_statuses';

    /**
     * The primary key associated with the table
     * @var string
     */
    protected $primaryKey = 'participant_status_id';

    /**
     * Indicates if the IDs are auto-incrementing.     *
     * @var bool
     */
    public $incrementing = true;

    /* One-to-Many Relationships */
    public function participants()
    {
        return $this->hasMany('App\Models\EventParticipant', 'participant_status_id', 'participant_status_id');
    }
}
