@extends('Admin.public.header')
@section('title', '管理组添加')
@section('content')
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span><i class="icon-pencil"></i>管理组添加</span>
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
    	<form class="mws-form" action="/group" method="post">
            {{csrf_field()}}
        	<div class="mws-form-inline">
            	<div class="mws-form-row">
                	<label class="mws-form-label">组名</label>
                	<div class="mws-form-item">
                    	<input type="text" class="large" name="rolename" placeholder="请输入2-12位中文">
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