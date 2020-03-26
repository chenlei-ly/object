<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Nodeinsert extends FormRequest
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
            'cname'=>'required|regex:/\w{2,20}/',
            'fname'=>'required|regex:/\w{2,20}/',
        ];
    }
    public function messages()
    {
        return[
            'cname.required'=>'控制器名不能为空',
            'cname.regex'=>'控制器名必须为2-20位的任意数字字母下划线',
            'fname.required'=>' 方法名不 能 为 空 ',
            'fname.regex'=>'方法名必须为6-12位的任意数字字母下划线',
        ];
    }
}
