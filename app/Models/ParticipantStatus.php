<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
