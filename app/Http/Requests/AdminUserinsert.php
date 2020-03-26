<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserinsert extends FormRequest
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
            'name'=>'required|regex:/\w{6,12}/|unique:admin_users',
            'pwd'=>'required|regex:/\w{6,12}/',
            'repwd'=>'required|regex:/\w{6,12}/|same:pwd',
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'用户名不能为空',
            'name.regex'=>'用户名必须为6-12位的任意数字字母下划线',
            'name.unique'=>'用户名重复',
            'pwd.required'=>' 密 码 不 能 为 空 ',
            'pwd.regex'=>'密码必须为6-12位的任意数字字母下划线',
            'repwd.required'=>'重复密码不能为空',
            'repwd.regex'=>'重复密码必须为6-12位的任意数字字母下划线',
            'repwd.same'=>'两次密码不一致',
        ];
    }
}
