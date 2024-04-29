<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BranchRequest extends FormRequest
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
        return [
            'branch_name_en' => 'required|unique:branches,branch_name_en,'.$request->branch,
            'branch_name_bn' => 'unique:branches,branch_name_bn,'.$request->branch,
        ];
    }

    public function messages(): array
    {
        return [
            'branch_name_en.required' => __('branch.branch_name_en_required'),
            'branch_name_en.unique' => __('branch.branch_name_en_unique'),
            'branch_name_bn.required' => __('branch.branch_name_bn_unique'),
        ];
    }
}
