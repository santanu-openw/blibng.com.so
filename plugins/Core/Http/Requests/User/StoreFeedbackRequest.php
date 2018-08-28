<?php

namespace Zix\Core\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreFeedbackRequest
 * @package Zix\Core\Http\Requests\User
 */
class StoreFeedbackRequest extends FormRequest
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
            'feedback_type' => ['required', Rule::in('Program', 'Coach', 'Sessions', 'App', 'Assessments', 'Resources')],
            'ease_of_use' => ['integer', 'between:0,5'],
            'informative' => ['integer', 'between:0,5'],
            'helpful' => ['integer', 'between:0,5'],
            'comment' => ['string']
        ];
    }
}
