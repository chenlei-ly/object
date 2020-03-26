<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Groupinsert extends FormRequest
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
            'rolename'=>'required|regex:/^[\x{4e00}-\x{9fa5}]{2,12}+$/u|unique:role',
        ];
    }
    public function messages()
    {
        return[
            'rolename.required'=>'组名不能为空',
            'rolename.regex'=>'组名必须为2-12位的汉字',
            'rolename.unique'=>'组名重复',
        ];
    }
}
