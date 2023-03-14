<?php

namespace App\Http\Requests\Admin\Corporation;

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
            'name' => 'required|string|unique:corporations,name,' . $this->corporation->id,
            'slug' => 'required|string',
            'server' => 'required|url',
            'login' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Это поле обязательно для заполнения.',
            'name.string' => 'Данные должны соответствовать строчному типу.',
            'name.unique' => 'Организация с таким названием уже существует',
            'slug.required' => 'Это поле обязательно для заполнения.',
            'slug.string' => 'Данные должны соответствовать строчному типу.',
            'server.required' => 'Это поле обязательно для заполнения.',
            'server.url' => 'Это поле должно быть URL-адресом.',
            'login.required' => 'Это поле обязательно для заполнения.',
            'login.string' => 'Данные должны соответствовать строчному типу.',
        ];
    }
}
