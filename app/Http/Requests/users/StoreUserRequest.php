<?php

namespace App\Http\Requests\users;

use App\Http\Requests\BaseFormRequest;

class StoreUserRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'password' => 'required',
            'department_id' => [
                'required',
                'numeric',
                'exists:departments,id',
                'unique:employees,department_id',
            ],
            'image' => 'nullable|image|max:2048',
            'manager_id' => [
                'nullable',
                'numeric',
                'exists:users,id'
            ],
        ];
    }
}
