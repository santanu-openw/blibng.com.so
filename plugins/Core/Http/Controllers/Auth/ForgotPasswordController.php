<?php

namespace Zix\Core\Http\Controllers\Auth;

use Illuminate\Support\Facades\Password;
use Zix\Core\Support\Traits\ApiResponses;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Zix\Core\Http\Requests\User\ForgotPasswordRequest;

/**
 * Class ForgotPasswordController
 * @package Zix\Core\Http\Controllers\Auth
 * @resource Authentication
 */
class ForgotPasswordController
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

    use SendsPasswordResetEmails, ApiResponses;

    /**
     * Send Reset Password Email.
     * ###1) Send reset password link:
     * - We will send the password reset link to this user.
     * - Once we have attempted to send the link.
     * - we will examine the response then see the message we need to show to the user.
     * - Finally, we'll send out a proper response.
     *
     * ###2) In case error and the email not found :
     * - If an error was returned by the password broker
     * - We will get this message translated so we can notify a user of the problem.
     * - We'll we'll send out and error message.
     *
     * @param ForgotPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(ForgotPasswordRequest $request)
    {
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        if ($response === Password::RESET_LINK_SENT) {
            return $this->respondWithData(trans($response));
        }

        return $this->respondBadRequest(trans($response));
    }
}