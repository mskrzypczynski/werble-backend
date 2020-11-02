<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
