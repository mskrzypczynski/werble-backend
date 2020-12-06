<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\EventType
 *
 * @property int $event_type_id
 * @property string $event_type_name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property-read int|null $events_count
 * @method static \Illuminate\Database\Eloquent\Builder|EventType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventType newQuery()
 * @method static \Illuminate\Database\Query\Builder|EventType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|EventType query()
 * @method static \Illuminate\Database\Eloquent\Builder|EventType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventType whereEventTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventType whereEventTypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|EventType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|EventType withoutTrashed()
 * @mixin \Eloquent
 */
class EventType extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The table associated with EventType model
     * @var string
     */
    protected $table = 'event_types';

    /**
     * The primary key associated with the table
     * @var string
     */
    protected $primaryKey = 'event_type_id';

    /**
     * Indicates if the IDs are auto-incrementing.    *
     * @var bool
     */
    public $incrementing = true;

    /* One-to-Many Relationships */
    public function events()
    {
        return $this->hasMany('App\Models\Event', 'event_type_id', 'event_type_id');
    }
}
