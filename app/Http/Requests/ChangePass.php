<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePass extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8',
        ];
    }

    public function messages():array
    {
        return [
            'password.required' => __('user.password_required'),
            'password.min' => __('user.password_max'),
            'confirm_password.min' => __('user.confirm_password_min')
        ];
    }
}
