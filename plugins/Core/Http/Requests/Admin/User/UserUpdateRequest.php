<?php

namespace Zix\Core\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update_users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'gender' => ['nullable', Rule::in(['Men', 'Women'])],
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'roles' => ['array']
        ];
    }
}
