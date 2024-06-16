<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'ten_dm' => 'required|string|max:255',
            'slug' => 'string|max:255|unique:categories,slug,' . $this->route('category'),
            'parent_id' => 'nullable|exists:categories,id'
        ];
    }
    public function messages()
    {
        return [
            'ten_dm.required' => 'Tên danh mục là bắt buộc.',
            'slug.unique' => 'Tên danh mục đã tồn tại, vui lòng chọn tên khác.',
            'parent_id.exists' => 'Danh mục cha không hợp lệ.',
        ];
    }
}
