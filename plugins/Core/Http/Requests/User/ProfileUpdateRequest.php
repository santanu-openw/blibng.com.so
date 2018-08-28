<?php

namespace Zix\Core\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class ProfileUpdateRequest
 */
class ProfileUpdateRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->id)],
            'phone_number' => ['required', 'max:255', Rule::unique('users', 'phone_number')->ignore($this->id)],
            'lang' => ['nullable', Rule::in(['en', 'fr'])],
            'gender' => ['nullable', Rule::in(['Men', 'Women'])],
        ];
    }
}
