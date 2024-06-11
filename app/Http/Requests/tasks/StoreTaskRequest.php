<?php

namespace App\Http\Requests\tasks;

use App\Http\Requests\BaseFormRequest;
use App\Models\Task;

class StoreTaskRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'subject' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|string',
            'status.*' => 'required|string|in:' . implode(",", Task::$statuses),
        ];
    }

}
