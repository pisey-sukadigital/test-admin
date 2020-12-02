<?php

namespace App\Http\Requests\Module;

use Illuminate\Foundation\Http\FormRequest;

class ModuleUpdateRequest extends FormRequest
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
            'name' => 'required|unique:modules,name,'.$this->id,
            'display' => 'required',
            'link' => 'required',
            'parent_id' => 'required',
            'sort' => 'required',
            'is_active' => 'required',
        ];
    }
}