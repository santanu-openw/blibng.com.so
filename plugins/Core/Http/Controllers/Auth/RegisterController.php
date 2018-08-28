<?php

namespace Zix\Core\Http\Controllers\Auth;

use App\User;
use Zix\Core\Events\UserRegistered;
use Zix\Core\Http\Requests\User\RegisterRequest;
use Zix\Core\Http\Resources\AuthenticationResource;

/**
 * Class RegisterController
 * @package Zix\Core\Http\Controllers\Auth
 * @resource Authentication
 */
class RegisterController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * @var User
     */
    public $user;

    /**
     * RegisterController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Register Participant.
     *  When the submit a register form we will be creating new account for him,
     * also we will be sending to him and email with link to activate him account.
     * @param RegisterRequest $request
     * @return AuthenticationResource
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->user->create([
            'user_id' => $this->getUserId(),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ]);

        event(new UserRegistered($user));

        return new AuthenticationResource($user);

    }

    /**
     * @return string
     */
    protected function getUserId(): string
    {
        if (User::all()->count()) {
            $latest_id = (int)User::orderByDesc('user_id')->first()->user_id;
        } else {
            $latest_id = 0;
        }
        return str_pad(($latest_id + 1), 4, "0", STR_PAD_LEFT);
    }


}