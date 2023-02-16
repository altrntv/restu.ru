<?php

namespace App\Http\Requests\Admin\Menuboard;

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
            'organization_id' => 'required|exists:organizations,id',
            'menu_json' => 'required|json',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Это поле обязательно для заполнения.',
            'name.string' => 'Данные должны соответствовать строчному типу.',
            'organization_id.required' => 'Это поле обязательно для заполнения.',
            'organization_id.string' => 'Данные должны соответствовать числовому типу.',
            'menu_json.required' => 'Это поле обязательно для заполнения.',
            'menu_json.json' => 'Данные должны соответствовать JSON формату.'
        ];
    }
}
