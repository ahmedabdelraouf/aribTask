<?php

namespace App\Http\Requests\users;

use App\Http\Requests\BaseFormRequest;
use App\Rules\ValidDepartmentID;
use App\Rules\ValidManagerID;
use Illuminate\Contracts\Validation\Validator;

class UpdateUserRequest extends BaseFormRequest
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
            'department_id' => ['nullable', new ValidDepartmentID()],
            'image' => 'nullable|image|max:2048',
            'manager_id' => ['nullable', new ValidManagerID()],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        parent::failedValidation($validator); // TODO: Change the autogenerated stub
    }
}
