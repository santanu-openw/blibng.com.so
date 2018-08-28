<?php

namespace Zix\Core\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Permission\Traits\HasRoles;
use Zix\Core\Models\Traits\UuidModelTrait;
use Zix\Core\Notifications\ResetPasswordNotification;
use Zix\Core\Notifications\ResetPasswordNotificationAdmin;

/**
 * Class Participant
 * @package Zix\Core\Models
 */
class BaseUser extends Authenticatable implements HasMedia
{
    use UuidModelTrait, Notifiable, HasRoles, HasApiTokens, HasMediaTrait;

    /**
     * @var string
     */
    protected $guard_name = 'api';


    /**
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        if ($this->hasRole('Admin')) {
            $this->notify(new ResetPasswordNotificationAdmin($token));
        } else {
            $this->notify(new ResetPasswordNotification($token));
        }
    }


    /**
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'notifications_' . $this->id;
    }

}
