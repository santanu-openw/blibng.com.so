<?php

namespace App;

use Zix\CarWash\Models\Traits\CarWashUserTrait;
use Zix\Core\Models\BaseUser;

/**
 * Class Participant
 * @package App
 */
class User extends BaseUser
{
    use CarWashUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'mobile_number', 'phone_number', 'user_id',
        'position', 'bio', 'gender', 'lang', 'first_name', 'last_name', 'full_name', 'avatar',
        'country', 'city', 'address', 'code_postal'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeAdmins($query)
    {
        return $query->whereHas('roles', function ($q) {
            return $q->where('name', 'Admin');
        });
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeCoaches($query)
    {
        return $query->whereHas('roles', function ($q) {
            return $q->where('name', 'Coach');
        });
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeParticipants($query)
    {
        return $query->whereHas('roles', function ($q) {
            return $q->where('name', 'Participant');
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function analyses()
    {
        return $this->hasMany(Analyser::class);
    }
}
