<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MenuLabelRequest extends FormRequest
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
            'order_by'      => 'required|unique:menu_labels,order_by,'.$request->menu_label,
            'label_name_en' => 'required',
        ];
    }

    public function messages(): array
    {
        return  [
            'order_by.required' => __('menu_label.order_by_error_required'),
            'order_by.unique' => __('menu_label.order_by_error_unique'),
            'label_name_en' => __('menu_label.label_name_en_required'),
        ];
    }
}
