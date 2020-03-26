@extends('Admin.public.header')
@section('title', '会员详细信息')
@section('content')
<div>
	<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span><i class="icon-table"></i>会员详细信息</span>
        </div>
        <div class="mws-panel-body no-padding">
            <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
            	<table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
	                <thead>
	                    <tr role="row">
	                    	<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 62px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">序号
	                    	</th>
	                    	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 62px;" aria-label="Browser: activate to sort column ascending">用户id
	                    	</th>
	                    	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 93px;" aria-label="Platform(s): activate to sort column ascending">真实姓名
	                    	</th>
	                    	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 85px;" aria-label="Engine version: activate to sort column ascending">年龄
	                    	</th>
	                    	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">性别
	                    	</th>
	                    	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 150px;" aria-label="CSS grade: activate to sort column ascending">电话
	                    	</th>
	                    	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">email
	                    	</th>
	                    	<th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 200px;" aria-label="CSS grade: activate to sort column ascending">住址
	                    	</th>
	                    </tr>
	                </thead>   
	            <tbody role="alert" aria-live="polite" aria-relevant="all">
	        		<tr class="odd">
	        			@if($data)
	                    <td class="  sorting_1">{{$data->id}}</td>
	                    <td class=" ">{{$data->uid}}</td>
	                    <td class=" ">{{$data->name}}</td>
	                    <td class=" ">{{$data->age}}</td>
	                    <td class=" ">{{$data->sex}}</td>
	                    <td class=" ">{{$data->tel}}</td>
	                    <td class=" ">{{$data->email}}</td>
	                    <td class=" ">{{$data->address}}</td>
	                    @else
	                    <td class="  sorting_1" colspan="8">对不起,您所查询的用户没有添加详细信息</td>
	                    @endif
	                </tr>
	            </tbody>
            </table>
            <div class="dataTables_info" id="DataTables_Table_1_info">Showing 1 to 10 of 57 entries</div>
        </div>
    </div>
</div>
@endsection
