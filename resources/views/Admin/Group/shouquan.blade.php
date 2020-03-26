@extends('Admin.public.header')
@section('title', '管理组授权')
@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-pencil"></i>管理组授权</span>
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
        <form class="mws-form" action="/doshouquan/{{$data->id}}" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">组名</label>
                    <div class="mws-form-item">
                        {{$data->rolename}}
                    </div>
                </div>
            </div>
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">权限名</label>
                    <div class="mws-form-item">
                        @foreach($datas as $v)
                        
                        <input type="checkbox" class="large" @if(in_array($v->id,$nids)) checked @endif name="node[]" value="{{$v->id}}">{{$v->name}}
                        
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
                <input type="submit" value="点击授权" class="btn btn-danger">
            </div>
        </form>
    </div>      
</div>
@endsection