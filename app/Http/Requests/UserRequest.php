<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        if(isset($request->method) == 'PUT')
        {
            $required = '';
            $min = '';
        }
        else
        {
            $required = 'required';
            $min = '|min:8';
        }
        return [
            'role_id' => 'required',
            'branch_id' => 'required',
            'user_name_en' => 'required',
            'email' => 'required|unique:users,email,'.$request->user.'|email_checker',
            'phone' => 'required|unique:users,phone,'.$request->user,
            'password' => $required.''.$min,
        ];
    }

    public function messages():array
    {
        if(isset($request->method) == 'PUT')
        {
            $required = '';
        }
        else
        {
            $return = [
                'password.required' => __('user.password_required'),
                'password.max' => __('user.password_max'),
            ];
        }
        $return = [
            'branch_id.required' => __('user.branch_id_required'),
            'role_id.required' => __('user.role_id_required'),
            'user_name_en.required' => __('user.user_name_en_required'),
            'email.required' => __('user.email_required'),
            'email.unique' => __('user.email_unique'),
            'phone.required' => __('user.phone_required'),
            'phone.unique' => __('user.phone_unique'),
            'email.email_checker' => __('user.email_checker'),
        ];

        return $return;
    }
}
