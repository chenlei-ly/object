@extends('Admin.public.header')
@section('title', '会员查看')
@section('content')
<div>
	<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span><i class="icon-table"></i>会员列表</span>
        </div>
        <div class="mws-panel-body no-padding">
            <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
            	<div class="dataTables_filter" id="DataTables_Table_1_filter">
            		<form action="/users" method="get">
	            		<label>用户名:
	            			<input type="text" aria-controls="DataTables_Table_1" name="username" value="{{$request['username'] or ''}}">
	            		</label>
	            		<label>状态:
	            			<select name="status" id="">
	            				<option value="xz">--请选择--</option>
								<option value="0" {{$select1}}>可用</option>
								<option value="1" {{$select2}}>禁用</option>
	            			</select>
	            		</label>
	            		<label>会员等级:
	            			<select name="member" id="">
	            				<option value="xz">--请选择--</option>
								<option value="0" {{$select3}}>普通会员</option>
								<option value="1" {{$select4}}>银卡会员</option>
								<option value="2" {{$select5}}>金卡会员</option>
								<option value="3" {{$select6}}>钻石会员</option>
	            			</select>
	            		</label>
	            		<input type="submit" value="查询" class="btn btn_info">
            		</form>
            	</div>
            	<table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
	                <thead>
	                    <tr role="row">
	                    	<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 62px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">id
	                    	</th>
	                    	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 206px;" aria-label="Browser: activate to sort column ascending">用户名
	                    	</th>
	                    	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 93px;" aria-label="Platform(s): activate to sort column ascending">状态
	                    	</th>
	                    	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 85px;" aria-label="Engine version: activate to sort column ascending">会员等级
	                    	</th>
	                    	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">本商城花费
	                    	</th>
	                    	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 150px;" aria-label="CSS grade: activate to sort column ascending">注册时间
	                    	</th>
	                    	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">操作
	                    	</th>
	                    </tr>
	                </thead>   
	            <tbody role="alert" aria-live="polite" aria-relevant="all">
	            @if($data->all())
	            @foreach($data as $v)
	            	<tr class="odd">
	                    <td class="  sorting_1">{{$v->id}}</td>
	                    <td class=" ">{{$v->username}}</td>
	                    <td class=" "><button class='but' gid="{{$v->id}}" status='{{$v->status}}'>{{$v->status?'禁用':'可用'}}</button></td>
	                    <td class=" ">{{$v->member}}</td>
	                    <td class=" ">{{$v->money}}元</td>
	                    <td class=" ">{{date("Y-m-d H:i:s",$v->addtime)}}</td>
	                    <td class=" ">
	                    	<a href="users/{{$v->id}}">查看详情</a>
	                    </td>
	                </tr>
	            @endforeach
	            @else
	            	<tr class="odd">
	            		<td class="  sorting_1" colspan="7">对不起,您所查询的数据不存在</td>
	            	</tr>
				@endif
	            </tbody>
            </table>
            <div class="dataTables_info" id="DataTables_Table_1_info">Showing 1 to 10 of 57 entries</div>
            <div id="page">
				<div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
            {{$data->appends($request)->render()}}
	        </div>
            </div>
            
        </div>
    </div>
</div>
<script>
    $('td button').click(function(){
			var id = $(this).attr('gid');
			var status = $(this).attr('status');
			// console.log(id);
			// console.log(status);
			var t = $(this);
			// console.log(status);
			$.get('/ajaxusers',{id:id,status:status},function(data){
				console.log(data[0]);
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
</script>
@endsection
