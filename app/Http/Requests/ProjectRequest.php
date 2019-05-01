<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $errorBag = 'project';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->isMethod('PATCH')) {
            return Gate::allows('update', $this->route('project'));
        }

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
            'title' => 'sometimes|required|string|max:255|unique:projects,title,' . $project_id,
            'description' => 'sometimes|required|string',
            'notes' => 'sometimes|string'
        ];
    }
}
