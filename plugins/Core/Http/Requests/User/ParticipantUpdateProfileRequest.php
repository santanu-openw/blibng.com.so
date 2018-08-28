<?php

namespace Zix\Core\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

/**
 * Class SetupProfileRequest
 * @package Zix\Core\Http\Requests\Participant
 */
class ParticipantUpdateProfileRequest extends FormRequest
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
            'program_id' => ['exists:programs,id'],
            'gender' => ['nullable', Rule::in(['Men', 'Women'])],
            'lang' => ['nullable', Rule::in(['en', 'fr'])]
        ];
    }
}
