<?php

namespace App\Http\Requests;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'sometimes|required|string|max:140',
            'content' => 'sometimes|required|string|max:300',
            'attachment' => 'sometimes|nullable|file',
            'done_at' => 'sometimes|nullable|date',
        ];
    }
}
