<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RoleRequest extends FormRequest
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
        // dd($request->role);
        return [
            'role_name_en' => 'required|unique:roles,name,'.$request->role,
            'role_name_bn' => 'unique:roles,name_bn,'.$request->role,
        ];
    }

    public function messages(): array
    {
        return  [
            'role_name_en.unique' => __('role.role_name_en_unique'),
            'role_name_en.required' => __('role.role_name_en_required'),
            'role_name_bn.unique' => __('role.role_name_bn_unique'),
        ];
    }
}
