<?php

namespace App\Http\Requests\Admin\Report;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'slug' => 'required|string',
            'icon' => 'required|string',
            'type_date' => 'required|string',
            'organization_id' => 'required|exists:organizations,id',
            'request_json' => 'required|json',
            'report_json' => 'required|json'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Это поле обязательно для заполнения.',
            'name.string' => 'Данные должны соответствовать строчному типу.',
            'description.required' => 'Это поле обязательно для заполнения.',
            'description.string' => 'Данные должны соответствовать строчному типу.',
            'slug.required' => 'Это поле обязательно для заполнения.',
            'slug.string' => 'Данные должны соответствовать строчному типу.',
            'icon.required' => 'Это поле обязательно для заполнения.',
            'icon.string' => 'Данные должны соответствовать строчному типу.',
            'type_date.required' => 'Это поле обязательно для заполнения.',
            'type_date.string' => 'Данные должны соответствовать строчному типу.',
            'organization_id.required' => 'Это поле обязательно для заполнения.',
            'organization_id.string' => 'Данные должны соответствовать числовому типу.',
            'request_json.required' => 'Это поле обязательно для заполнения.',
            'request_json.json' => 'Данные должны соответствовать JSON формату.',
            'report_json.required' => 'Это поле обязательно для заполнения.',
            'report_json.json' => 'Данные должны соответствовать JSON формату.',
        ];
    }
}
