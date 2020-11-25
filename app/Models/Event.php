<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    /**
     *  Model uses SoftDeletes to not delete records from DB.
     *  Also while deleting we switch entity's is_active attribute to false.
     */
    use HasFactory,SoftDeletes;

    /**
     * The table associated with Event model
     * @var string
     */
    protected $table = 'events';

    /**
     * The primary key associated with the table
     * @var string
     */
    protected $primaryKey = 'event_id';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_active' => true,
        'event_visibility_level_id' =>1,
        'event_status_id' => 1,
        'event_creator_id' => 1,
        'event_type_id' => 1,
    ];

    protected $fillable = [
        'name' ,
        'location',
        'description',
        'datetime'
    ];


    /* One-to-Many Relationships */
    public function participants()
    {
        return $this->hasMany('App\Models\EventParticipant', 'event_id', 'event_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\EventReview', 'event_id', 'event_id');
    }

    /* One-to-One Relationships */
    public function creator(){
        return $this->belongsTo('App\Models\User','user_id','event_creator_id');
    }

    public function status(){
        return $this->belongsTo('App\Models\EventStatus','event_status_id','event_status_id');
    }

    public function type(){
        return $this->belongsTo('App\Models\EventType','event_type_id','event_type_id');
    }
}
