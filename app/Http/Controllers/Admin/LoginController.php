<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin/Login/login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin/index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
                $result = DB::select("select cname,fname from user_role,role_node,node where user_role.rid = role_node.rid and role_node.nid = node.id and user_role.uid = {$res->id}");
                $nodelist['LoginController'][] = 'index';
                $nodelist['LogoutController'][] = 'index';
                foreach($result as $v){
                    $nodelist[$v->cname][] = $v->fname;
                    if($v->fname == 'create'){
                        $nodelist[$v->cname][] = "store";
                    }
                    if($v->fname == 'edit'){
                        $nodelist[$v->cname][] = "update";
                    }
                }
                session(['nodelist'=>$nodelist]);
                return view('Admin/index');
            } else {
                //密码不正确
                return back()->with('error','密码不正确');
            }
        } else {
            //用户名不存在
            return back()->with('error','用户名不存在');
        }
    }
}
