<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StorePeople extends FormRequest
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
            'username'=>[
                'regex:/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_-]{2,12}$/u',
                Rule::unique('people')->ignore($id,'p_id')
                ],
            'age'=>'required|integer|between:1,200',
        ];
    }
    public function messages(){
        return [
            'username.required'=>'名称必填',
            'username.regex'=>'名称由中文字母数字下划线长度2-12位',
            'username.unique'=>'名称已存在',
            'username.max'=>'名称最大长度12',
            'username.min'=>'名称最小长度2',
            'age.required'=>'年龄必填',
            'age.integer'=>'年龄必须是数字',
            'age.between'=>'年龄最大长度3'
        ];
    }

}
