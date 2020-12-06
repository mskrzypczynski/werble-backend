<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\EventStatus
 *
 * @property int $event_status_id
 * @property string $event_status_name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property-read int|null $events_count
 * @method static \Illuminate\Database\Eloquent\Builder|EventStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventStatus newQuery()
 * @method static \Illuminate\Database\Query\Builder|EventStatus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EventStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|EventStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventStatus whereEventStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventStatus whereEventStatusName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|EventStatus withTrashed()
 * @method static \Illuminate\Database\Query\Builder|EventStatus withoutTrashed()
 * @mixin \Eloquent
 */
class EventStatus extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with EventStatus model
     * @var string
     */
    protected $table = 'event_statuses';

    /**
     * The primary key associated with the table
     * @var string
     */
    protected $primaryKey = 'event_status_id';

    /**
     * Indicates if the IDs are auto-incrementing.   *
     * @var bool
     */
    public $incrementing = true;

    /* One-to-Many Relationships */
    public function events()
    {
        return $this->hasMany('App\Models\Event', 'event_status_id', 'event_status_id');
    }
}
