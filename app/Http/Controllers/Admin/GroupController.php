<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Groupinsert;
use DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $num = $request->input('num',1);
        $page = 5;
        $start = ($num-1)*$page;
        $count = DB::table('role')->count();
        $maxpage = ceil($count/$page);
        $p = array();
        for($i=1;$i<=$maxpage;$i++){
            $p[] = $i;
        }
        $data = DB::select("select * from role order by id asc limit {$start},{$page}");
        if($request->ajax()){
            return view('Admin/Group/ajax',['data'=>$data,'p'=>$p,'newpage'=>$num]);
        }
        return view('Admin/Group/show',['data'=>$data,'p'=>$p,'newpage'=>$num]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin/Group/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Groupinsert $request)
    {
        $rolename = array('rolename'=>$request->input('rolename'));

        $res = DB::table('role')->insert($rolename);
        if($res){
            return redirect("/group")->with('success','管理组添加成功');
        } else {
            return back()->with('error','管理组添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('role')->where('id','=',$id)->first();
        return view('Admin/Group/update',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Groupinsert $request, $id)
    {
        $rolename = $request->input('rolename');
        $res = DB::table('role')->where('id','=',$id)->update(['rolename'=>$rolename]);
        if($res){
            return redirect("/group")->with('success','管理组修改成功');
        } else {
            return back()->with('error','管理组修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function del(Request $request){
        $id = $_GET['id'];
        $result = DB::table('role')->where('id','=',$id)->delete();
        if($result){
            echo 1;
        } else {
             echo 2;
        }
    }
    public function shouquan(Request $request,$id){
        $data = DB::table('role')->where('id','=',$id)->first();
        $row = DB::table('role_node')->where('rid','=',$id)->get();
        $nids = array(); 
        foreach($row as $value){
            $nids[] = $value->nid;
        }
        $datas = DB::table('node')->get();
        return view('Admin.Group.shouquan',['data'=>$data,'datas'=>$datas,'nids'=>$nids]);
    }
    public function doshouquan(Request $request,$id){
        $nids = $request->input('node');
        DB::table('role_node')->where('rid','=',$id)->delete();
        foreach($nids as $v){
            $data['rid'] = $id;
            $data['nid'] = $v;
            $res = DB::table('role_node')->insert($data);
        }
        if($res){
            return redirect('group')->with('success','授权成功');
        } else {
            return back()->with('error','授权失败');
        }
    }
}
