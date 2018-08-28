<?php

namespace Zix\Core\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Zix\Core\Rules\Base64Validator;

/**
 * Class UpdateAvatarRequest
 * @package Zix\Core\Http\Requests\User
 */
class UpdateAvatarRequest extends FormRequest
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
            'avatar' => ['required', new Base64Validator]
        ];
    }
}
