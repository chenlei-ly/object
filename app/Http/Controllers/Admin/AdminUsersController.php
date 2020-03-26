<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserInsert;
use DB;
use Hash;
class AdminUsersController extends Controller
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
        $count = DB::table('admin_users')->count();
        $maxpage = ceil($count/$page);
        $p = array();
        for($i=1;$i<=$maxpage;$i++){
            $p[] = $i;
        }
        $data = DB::select("select admin_users.id,admin_users.name,admin_users.status,user_role.uid,user_role.rid,role.rolename from admin_users,user_role,role where admin_users.id = user_role.uid and user_role.rid = role.id order by admin_users.id asc limit {$start},{$page}");
        if($request->ajax()){
            return view('Admin/Admin_users/ajax',['data'=>$data,'p'=>$p,'newpage'=>$num]);
        }
        return view('Admin/Admin_users/show',['data'=>$data,'p'=>$p,'newpage'=>$num]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin/Admin_users/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserinsert $request)
    {
        $role['rid'] = $request->input('role');
        $arr = $request->except('_token','repwd','role');
        $arr['status'] = 0;
        $arr['pwd']=Hash::make($arr['pwd']);
        $role['uid'] = DB::table('admin_users')->insertGetId($arr);
        $res = DB::table('user_role')->insert($role);
        if($role['uid'] && $res){
            return redirect("/adminusers")->with('success','管理员添加成功');
        } else {
            return back()->with('error','管理员添加失败');
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::select("select admin_users.id,admin_users.name,admin_users.status,user_role.uid,user_role.rid,role.rolename from admin_users,user_role,role where admin_users.id = user_role.uid and user_role.rid = role.id and admin_users.id = {$id}");
        $a = $b = $c = $d = '';
        switch($data[0]->rid){
            case 1;
                $a = 'selected';
                break;
            case 2;
                $b = 'selected';
                break;
            case 3;
                $c = 'selected';
                break;
            case 4;
                $d = 'selected';
                break;
        }
        return view('Admin/Admin_users/update',['data'=>$data[0],'a'=>$a,'b'=>$b,'c'=>$c,'d'=>$d]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rid = $request->input('role');
        $res = DB::table('user_role')->where('uid','=',$id)->update(['rid'=>$rid]);
        if($res){
            return redirect('/adminusers')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
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
    public function dologin(Request $request)
    {
        $name = $request->input('name');
        $pwd = $request->input('pwd');
        $res = DB::table('admin_users')->where('name','=',$name)->first();
        if($res){
            if(DB::table('admin_users')->where('pwd','=',$pwd)->first()){
                session(['adminname'=>"$name"]);
                session(['adminid'=>"$res->id"]);
            } else {
                //密码不正确
                return view('Admin/Admin_users/login');
            }
        } else {
            //用户名不存在
            return view('Admin/Admin_users/login');
        }
    }
    public function ajax(){
        $num = '';
        $id = $_GET['id'];
        $status = $_GET['status'];
        if($status == 0){
            $num = 1;
        } elseif($status == 1){
            $num = 0;
        }
        echo $num;
        $res = DB::table('admin_users')->where('id','=',$id)->update(['status'=>$num]);
        if($res){
            echo 1;
        } else {
            echo 0;
        }
    }
    public function del(Request $request){
        $id = $_GET['id'];
        $res = DB::table('admin_users')->join('user_role','admin_users.id','=','user_role.uid')->join('role','user_role.rid','=','role.id')->where('admin_users.id','=',$id)->first();
        if($res->rid == 1){
            echo 0;
        } else {
            $result = DB::table('admin_users')->where('id','=',$id)->delete();
            if($request){
                echo 1;
            } else {
                echo 2;
            }
        }
    }
}
