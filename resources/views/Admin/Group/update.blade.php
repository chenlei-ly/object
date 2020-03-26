@extends('Admin.public.header')
@section('title', '管理组修改')
@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-pencil"></i>管理组修改</span>
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
        <form class="mws-form" action="/group/{{$data->id}}" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">组名</label>
                    <div class="mws-form-item">
                        <input type="text" class="large" name="rolename" value="{{$data->rolename}}">
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