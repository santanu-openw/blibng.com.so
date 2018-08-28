<?php

namespace Zix\Core\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

/**
 * Class CoachUpdateProfileRequest
 * @package Zix\Core\Http\Requests\Coach
 */
class CoachUpdateProfileRequest extends FormRequest
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
            'first_name' => ['required','string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . ($this->user() ? $this->user()->id : null)],
            'phone_number' => ['required', 'string', 'max:255', 'unique:users,phone_number,' . ($this->user() ? $this->user()->id : null)],
            'bio' => ['required'],
            'position' => ['required', 'max:255'],
            'lang' => ['nullable', Rule::in(['en', 'fr'])],
            'gender' => ['nullable', Rule::in(['Men', 'Women'])],
        ];
    }
}
