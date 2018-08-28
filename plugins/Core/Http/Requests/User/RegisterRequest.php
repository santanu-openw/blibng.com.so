<?php

namespace Zix\Core\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegisterRequest
 * @package Zix\Core\Http\Requests\Participant
 */
class RegisterRequest extends FormRequest
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
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }
}