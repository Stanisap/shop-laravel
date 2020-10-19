<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
        return [
            'name' => 'required|min:3|max:255',
            'name_en' => 'required|min:3|max:255',
        ];
    }

    /**
     * Returning an array of messages when a validation error occurs
     *
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'required' => 'Поле :attribute должно быть заполненно',
            'min' => 'Поле :attribute должно иметь :min символов',
            'name.min' => 'Поле "название" должно иметь :min символов',
            'name_en.min' => 'Поле "название en" должно иметь :min символов на английском языке',
        ];
    }
}
