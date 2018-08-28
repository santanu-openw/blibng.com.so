<?php

namespace Zix\Core\Http\Controllers\Auth;

use App\User;
use Zix\Core\Http\Requests\User\ForgotPasswordSMSRequest;
use Zix\Core\Notifications\SendSMSResetPasswordNotification;
use Zix\Core\Support\Traits\ApiResponses;

/**
 * Class ForgotPasswordController
 * @package Zix\Core\Http\Controllers\Auth
 * @resource Authentication
 */
class ForgotPasswordSMSController
{

    /*
       |--------------------------------------------------------------------------
       | Password Reset Controller
       |--------------------------------------------------------------------------
       |
       | This controller is responsible for handling password reset emails and
       | includes a trait which assists in sending these notifications from
       | your application to your users. Feel free to explore this trait.
       |
       */

    use  ApiResponses;

    /**
     * Send Reset Password SMS.
     * This will send a 4 digits code for client if the mobile number is associated with him account
     * @param ForgotPasswordSMSRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(ForgotPasswordSMSRequest $request)
    {
        $user = User::where('mobile_number', $request->get('mobile_number'))->first();
        if ($user) {
            $mobile_code = rand(1000, 9999);
            $user->mobile_number_code = $mobile_code;

            $user->save();

            $user->notify(new SendSMSResetPasswordNotification($mobile_code));

            return $this->respondDataCreated("Your Ping Code Has Been Sent Successfully To :".$user->mobile_number);
        }


        return $this->respondBadRequest("Oops, Looks like something went wrong please check your mobile number or try again later");
    }
}