<?php

namespace App\Http\Requests\employees;

use App\Http\Requests\BaseFormRequest;

class StoreEmployeeRequest extends BaseFormRequest
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
            'salary' => 'required|numeric',
            'department_id' => [
                'required',
                'numeric',
                'exists:departments,id',
                'unique:employees,department_id',
            ],
            'image' => 'nullable|image|max:2048',
            'manager_name' => 'required|string|max:255',
        ];
    }
}
