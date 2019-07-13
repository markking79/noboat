<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PackFilterRequest extends FormRequest
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
            'pack_weight_units' => [
                'nullable',
                Rule::in(['imperial', 'metric'])

            ],
            'pack_filter_ounces_min' => 'nullable|integer|between:0,300',
            'pack_filter_ounces_max' => 'nullable|integer|between:0,300',
            'pack_filter_cost_min' => 'nullable|integer|between:0,2000',
            'pack_filter_cost_max' => 'nullable|integer|between:0,2000',
            'pack_filter_season_id' => 'nullable|integer|exists:pack_seasons,id',
        ];
    }
}
