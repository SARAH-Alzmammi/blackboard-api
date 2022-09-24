<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssignmentRequest extends FormRequest
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
        return [
            'name'=>['sometimes,required'], 
            'instructions'=>['sometimes,required'],
            'file'=>['sometimes,required','mimes:doc,docx,pdf'],
            'weight'=>['sometimes,required'],
            'allowed_attempts'=>['sometimes,required'],
            'deadline'=>['sometimes,required'],
        ];
    }
}
