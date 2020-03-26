@extends('Admin.public.header')
@section('title', '管理员添加')
@section('content')
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span><i class="icon-pencil"></i>管理员添加</span>
    </div>
    @if (count($errors) > 0)
    <div class="mws-form-message warning">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif
    <div class="mws-panel-body no-padding">
    	<form class="mws-form" action="/adminusers" method="post">
            {{csrf_field()}}
        	<div class="mws-form-inline">
            	<div class="mws-form-row">
                	<label class="mws-form-label">用户名</label>
                	<div class="mws-form-item">
                    	<input type="text" class="large" name="name" placeholder="请输入6-12位英文">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">密码</label>
                    <div class="mws-form-item">
                        <input type="password" class="large" name="pwd" placeholder="请输入6-12密码">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">确认密码</label>
                    <div class="mws-form-item">
                        <input type="password" class="large" name="repwd" placeholder="请确认密码">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">管理组</label>
                    <div class="mws-form-item">
                        <select name="role" id="">
                            <option value="1">超级管理员</option>
                            <option value="2">商品管理员</option>
                            <option value="3">评论管理员</option>
                            <option value="4">订单管理员</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
            	<input type="submit" value="添加" class="btn btn-danger">
            </div>
        </form>
    </div>    	
</div>
@endsection