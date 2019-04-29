<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
        $project_id = $this->isMethod('PATCH') ? $this->route('project')->id : '';

        return [
            'title' => 'required|string|max:255|unique:projects,title,' . $project_id,
            'description' => 'required|string',
        ];
    }
}
