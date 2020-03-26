<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DiscussController extends Controller
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
        $count = DB::table('discuss')->count();
        $maxpage = ceil($count/$page);
        $p = array();
        for($i=1;$i<=$maxpage;$i++){
            $p[] = $i;
        }
        $data = DB::select("select discuss.id,discuss.content,discuss.addtime,users.username from discuss,users where discuss.uid = users.id order by discuss.id asc limit {$start},{$page}");
        if($request->ajax()){
            return view('Admin/Discuss/ajax',['data'=>$data,'p'=>$p,'newpage'=>$num]);
        }
        return view('Admin/Discuss/show',['data'=>$data,'p'=>$p,'newpage'=>$num]);
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
        $data = DB::select("select discuss.content,users.username from discuss,users where discuss.uid = users.id and discuss.id = $id");
        return view('Admin.Discuss.info',['data'=>$data[0]]);
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
    public function del(Request $request){
        $id = $_GET['id'];
        $result = DB::table('discuss')->where('id','=',$id)->delete();
        if($result){
            echo 1;
        } else {
             echo 2;
        }
    }
}
