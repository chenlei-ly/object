@extends('Admin.public.header')
@section('title', '管理员查看')
@section('content')
<div class="mws-panel grid_8" id="box">
	<div class="mws-panel-header">
    	<span><i class="icon-table"></i>管理员列表</span>
    </div>
    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
        	<div class="dataTables_filter" id="DataTables_Table_1_filter">
        		<label>用户名:
        			<input type="text" aria-controls="DataTables_Table_1">
        		</label>
        	</div>
        	<table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row">
                    	<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 162px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">id
                    	</th>
                    	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 206px;" aria-label="Browser: activate to sort column ascending">用户名
                    	</th>
                    	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 193px;" aria-label="Platform(s): activate to sort column ascending">管理员所属组
                    	</th>
                    	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 135px;" aria-label="Engine version: activate to sort column ascending">状态
                    	</th>
                    	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">操作
                    	</th>
                    </tr>
                </thead>   
	            <tbody role="alert" aria-live="polite" aria-relevant="all">
	            @foreach($data as $v)
	            	<tr class="odd">
	                    <td class="  sorting_1">{{$v->id}}</td>
	                    <td class=" ">{{$v->name}}</td>
	                    <td class=" ">{{$v->rolename}}</td>
	                    <td class=" "><button class='but' gid="{{$v->id}}" status='{{$v->status}}'>{{$v->status?'禁用':'可用'}}</button></td>
	                    <td class=" ">
	                    	<a href="javascript:void(0)" onclick='del({{$v->id}},{{$newpage}})' class="del">删除</a>|
							<a href="adminusers/{{$v->id}}/edit">修改</a>
	                    </td>
	                </tr>
	            @endforeach
	            </tbody>
        	</table>
        	<div class="dataTables_info" id="DataTables_Table_1_info">Showing 1 to 10 of 57 entries</div>
        	<div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
            	@foreach($p as $v)
            	<button class="btn btn-info" onclick="page({{$v}})">{{$v}}</button>
            	@endforeach
    		</div>
    	</div>
	</div>
</div>
<script>
    //分页
    function page(num) {
    	$.get('/adminusers',{'num':num},function(data){
    		//alert(data);
    		$('#box').html(data);
    	})
    }
    //状态修改
    $('td button').click(function(){
        var id = $(this).attr('gid');
        var status = $(this).attr('status');
        var t = $(this);
        // console.log(status);
        $.get('/ajaxadminusers',{id:id,status:status},function(data){
            //console.log(data[0]);
            if(data[1] == 1){
                //console.log(data);
                if(status == 0){
                    t.attr('status',data[0]);
                    t.html('禁用');
                } else {
                    t.attr('status',data[0]);
                    t.html('可用');
                }
            } else if(data[1] == 0) {
                alert('修改失败');
            }
        })
    });
    //删除
    function del(id,newpage){
        $.get('/del',{id:id},function(data){
            //console.log(data);
            if(data == 1){
                page(newpage);
            } else if (data == 0){
                alert('您是超级管理员,不能删除自己');
            } else {
                alert('删除失败');
            }
        });
    }
</script>
@endsection