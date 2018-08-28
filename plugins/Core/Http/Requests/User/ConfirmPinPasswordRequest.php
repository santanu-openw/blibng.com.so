<?php

namespace Zix\Core\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ConfirmPinPasswordRequest
 * @package Zix\Core\Http\Requests\Participant
 */
class ConfirmPinPasswordRequest extends FormRequest
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
            'mobile_number' => ['required', 'exists:users,mobile_number'],
            'mobile_number_code' => ['required', 'exists:users,mobile_number_code'],
        ];
    }
}
