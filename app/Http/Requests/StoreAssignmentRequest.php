<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssignmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Question : Where is the best place to check the authorization?
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'chapter_id'=>['required'], 
            'name'=>['required'], 
            'instructions'=>'sometimes|required',
            'file'=>'required|mimes:doc,docx,pdf',
            'weight'=>['required'],
            'allowed_attempts'=>'required',
            'deadline'=>['required'],
        ];
    }
}
