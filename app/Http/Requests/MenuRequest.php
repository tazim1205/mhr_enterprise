<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MenuRequest extends FormRequest
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
        $rules =[];
        if($request->type == 2)
        {
            $rules['parent_id'] = 'required';
            $rules['route'] = 'required|unique:menus,route,'.$request->menu;
            $rules['slug'] = 'required';
        }

        if($request->type == 3)
        {
            $rules['icon'] = 'required';
            $rules['route'] = 'required|unique:menus,route,'.$request->menu;
            $rules['slug'] = 'required';
            $rules['label_id'] = 'required';
        }

        if($request->type == 1)
        {
            $rules['icon'] = 'required';
            $rules['label_id'] = 'required';
        }

        $rules['menu_name_en'] = 'required|unique:menus,menu_name_en,'.$request->menu;
        $rules['menu_name_bn'] = 'unique:menus,menu_name_bn,'.$request->menu;
        $rules['order_by'] = 'required';
        $rules['system_name'] = 'required|unique:menus,system_name,'.$request->menu;

        return $rules;
    }

    public function messages(): array
    {
        return [
            'parent_id.required' => __('menu.parent_id_required'),
            'menu_name_en.required' => __('menu.menu_name_en_required'),
            'menu_name_en.unique' => __('menu.menu_name_en_unique'),
            'menu_name_bn.unique' => __('menu.menu_name_bn_unique'),
            'system_name.required' => __('menu.system_name_required'),
            'system_name.unique' => __('menu.system_name_unique'),
            'route.required' => __('menu.route_required'),
            'route.unique' => __('menu.route_unique'),
            'icon.required' => __('menu.icon_required'),
            'order_by.required' => __('menu.order_by_required'),
            'label_id.required' => __('menu.label_id_required'),
            'slug.required' => __('menu.slug_required'),
        ];
    }
}
