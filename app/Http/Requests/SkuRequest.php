<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkuRequest extends FormRequest
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
            'price' => 'required|numeric|min:2',
            'count' => 'required|numeric|min:0',
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
            'price.min' => 'Поле "описание" должно иметь :min символов',
            'price.numeric' => 'В это поле нужно вводить цыфры',
            'count.numeric' => 'В этом поле нужно вводить цыфры',
        ];
    }
}
