<?php

namespace Zix\Core\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ResetPasswordRequest
 * @package Zix\Core\Http\Requests\Participant
 */
class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => ['required', 'string'],
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', 'max:255', 'min:6'],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }
}