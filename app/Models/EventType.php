<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
