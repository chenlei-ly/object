@extends('Admin.public.header')
@section('title', '管理员修改')
@section('content')
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span><i class="icon-pencil"></i>管理员修改</span>
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
    	<form class="mws-form" action="/adminusers/{{$data->id}}" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
        	<div class="mws-form-inline">
            	<div class="mws-form-row">
                	<label class="mws-form-label">用户名:</label>
                	<div class="mws-form-item">
                    	<input type="text" class="large" value="{{$data->name}}" readonly="readonly">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">管理组</label>
                    <div class="mws-form-item">
                        <select name="role" id="">
                            <option value="1" {{$a}}>超级管理员</option>
                            <option value="2" {{$b}}>商品管理员</option>
                            <option value="3" {{$c}}>评论管理员</option>
                            <option value="4" {{$d}}>订单管理员</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
            	<input type="submit" value="点击修改" class="btn btn-danger">
            </div>
        </form>
    </div>    	
</div>
@endsection