<?php

namespace Zix\CarWash\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
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
            'package_id' => ['required', Rule::exists('packages', 'id')],
            'plan_id' => ['required', Rule::exists('plans', 'id')],
            'car_size_id' => [Rule::exists('car_sizes', 'id')],
        ];
    }
}
