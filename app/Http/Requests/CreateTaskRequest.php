<?php

namespace App\Http\Requests;

class CreateTaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:140',
            'content' => 'required|string|max:300',
            'attachment' => 'sometimes|nullable|file',
        ];
    }
}
