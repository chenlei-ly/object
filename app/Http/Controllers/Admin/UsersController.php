<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $username = $request->input('username');
        $status = $request->input('status');
        $member = $request->input('member');
        $data = DB::table('users')
        ->where('username','like',"%{$username}%")
        ->where(function($query1) use($status){
            if ($status != null && $status != 'xz'){
                $query1->where('status','=',$status);
            }
        })
        ->where(function($query2) use($member){
            if ($member != null && $member != 'xz'){
                $query2->where('member','=',$member);
            }
        })
        ->paginate(2);
         $select1 = $select2 = $select3 = $select4 = $select5 = $select6 = '';
        if($status != null && $status != 'xz' && $status == 0){
            $select1 = 'selected';
        } elseif($status != null && $status != 'xz' && $status == 1){
            $select2 = 'selected';
        }
        switch ($member) {
            case '0':
                $select3 = 'selected';
                break;
            case '1':
                $select4 = 'selected';
                break;
            case '2':
                $select5 = 'selected';
                break;
            case '3':
                $select6 = 'selected';
                break;
        }
        $member = array('普通会员','银卡会员','金卡会员','砖石会员');
        foreach($data as $vv){
            //$vv->status = $arr[$vv->status];
            $vv->member = $member[$vv->member];
        }
        return view('Admin/users/show',['data'=>$data,'request'=>$request->all(),'select1'=>$select1,'select2'=>$select2,'select3'=>$select3,'select4'=>$select4,'select5'=>$select5,'select6'=>$select6]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $data = DB::table('user_info')->where('uid','=',$id)->first();
        $arr = array('女','男');
        if($data){
            $data->sex = $arr[$data->sex];
        }
        return view('Admin/users/user_info',['data'=>$data]);
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
    public function ajax(){
        $num = '';
        $id = $_GET['id'];
        $status = $_GET['status'];
        //echo $id;
        //echo $status;
        if($status == 0){
            $num = 1;
        } elseif($status == 1){
            $num = 0;
        }
        echo $num;
        $res = DB::table('users')->where('id','=',$id)->update(['status'=>$num]);
        if($res){
            echo 1;
        } else {
            echo 0;
        }
    }
}
