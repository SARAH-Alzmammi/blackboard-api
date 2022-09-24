<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentAssignmentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        // TODO: Make sure the grad does not come through
        return [
            'user_id'=>['required'], 
            'assignment_id'=>['required'], 
            'file'=>'required|mimes:doc,docx,pdf',
            'attempt'=>'sometimes|required',
        ];
    }
}
