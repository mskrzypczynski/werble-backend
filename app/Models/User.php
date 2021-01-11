<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * App\Models\User
 *
 * @property int $user_id
 * @property string $login
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $birth_date
 * @property string|null $description
 * @property float|null $longitude
 * @property float|null $latitude
 * @property int $is_admin
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserFriend[] $beingFriends
 * @property-read int|null $being_friends_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property-read int|null $events_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserFriend[] $havingFriends
 * @property-read int|null $having_friends_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventParticipant[] $participants
 * @property-read int|null $participants_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    /**
     *  Model uses SoftDeletes to not delete records from DB.
     *  Also while deleting we switch entity's is_active attribute to false.
     *  User must verify email
     */
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes, CascadeSoftDeletes;

    /**
     * The table associated with User model
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key associated with the table
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        #credentials
        'login',
        'email',
        'password',

        #profile
        'first_name',
        'last_name',
        'birth_date',
        'description',

        #localization
        'longitude',
        'latitude',

        #statuses
        'is_admin',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_admin' => 0,
        'is_active' => 1,
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $cascadeDeletes = ['events', 'participants'];


    /* One-to-Many Relationships */

    //return events Owned by the user
    public function events()
    {
        return $this->hasMany('App\Models\Event', 'event_creator_id', 'user_id');
    }

    // returns event_participants models
    public function participants()
    {
        return $this->hasMany('App\Models\EventParticipant', 'user_id', 'user_id');
    }

    // Return events the user is participating
    public function eventsParticipating($with_participants = false)
    {
        $participants = $this->participants()->get();
        if ($with_participants)

            $events = collect($participants)->map(function ($p) {
                return $p->event()->with(['participants:event_participant_id,user_id,event_id'])->first();
            });
        else
            $events = collect($participants)->map(function ($p) {
                return $p->event()->first();
            });
        return $events;
    }

    //checks if user's is_admin is set
    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function findForPassport($username)
    {
        return $this->where('login', $username)->first();
    }
}
