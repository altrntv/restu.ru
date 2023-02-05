<?php

namespace App\Http\Requests\Admin\User;

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
            'email' => 'required|string|email|unique:users,email,' . $this->user->id,
            'organization_id' => 'required|exists:organizations,id',
            'role' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Это поле обязательно для заполнения.',
            'name.string' => 'Данные должны соответствовать строчному типу.',
            'email.required' => 'Это поле обязательно для заполнения.',
            'email.string' => 'Данные должны соответствовать строчному типу.',
            'email.email' => 'Почта должна соответствовать формату example@email.com',
            'email.unique' => 'Пользователь с таким email уже существует',
            'organization_id.required' => 'Это поле обязательно для заполнения.',
            'organization_id.string' => 'Данные должны соответствовать числовому типу.',
            'role.required' => 'Это поле обязательно для заполнения.',
            'role.string' => 'Данные должны соответствовать числовому типу.',
        ];
    }
}
