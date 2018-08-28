<?php

namespace Zix\Core\Http\Controllers\Auth;

use App\User;
use Illuminate\Auth\Passwords\DatabaseTokenRepository;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Zix\Core\Http\Requests\User\ConfirmPinPasswordRequest;
use Zix\Core\Http\Requests\User\ResetPasswordRequest;
use Zix\Core\Http\Requests\User\ResetPasswordSMSRequest;
use Zix\Core\Http\Resources\Participant\AuthenticationResource;
use Zix\Core\Support\Traits\ApiResponses;

/**
 * Class ResetPasswordController
 * @package Zix\Core\Http\Controllers\Auth
 * @resource Authentication
 */
class ResetPasswordSMSController
{
    use SendsPasswordResetEmails;
    /**
     * @var
     */
    protected $user;

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ApiResponses;

    /**
     * Confirm Mobile PIN
     * @param ConfirmPinPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmPin(ConfirmPinPasswordRequest $request)
    {
        $user = User::where('mobile_number', $request->get('mobile_number'))
            ->where('mobile_number_code', $request->get('mobile_number_code'))
            ->first();
        if ($user) {
            return $this->respondWithData([
                'token' => $user->id,
                'email' => $user->email
            ]);
        }

        return $this->respondBadRequest("Oops, Looks like something went wrong please check your mobile number or try again later");
    }

    /**
     * Reset Participant Password SMS.
     * @param  ResetPasswordSMSRequest $request
     * @return \Illuminate\Http\JsonResponse|AuthenticationResource
     */
    public function reset(ResetPasswordSMSRequest $request)
    {
        $user = User::where('id', $request->get('token'))
            ->where('mobile_number', $request->get('mobile_number'))
            ->where('mobile_number_code', $request->get('mobile_number_code'))
            ->first();

        if($user) {
            $user->forceFill([
                'password' => bcrypt($request->get('password')),
                'mobile_number_code' => null
            ])->save();
            // remove the old token.
            $user->tokens()->where('name', $request->header('Participant-Agent'))->delete();
            return new AuthenticationResource($user);
        }
        return $this->respondBadRequest("Oops, Looks like something went wrong please check your mobile number or try again later");
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword $user
     * @param  string $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $this->user = $user;
        return $user->forceFill([
            'password' => bcrypt($password)
        ])->save();;
    }

}