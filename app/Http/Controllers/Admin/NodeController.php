<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\Nodeinsert;

class NodeController extends Controller
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
        $count = DB::table('node')->count();
        $maxpage = ceil($count/$page);
        $p = array();
        for($i=1;$i<=$maxpage;$i++){
            $p[] = $i;
        }
        $data = DB::select("select * from node order by id asc limit {$start},{$page}");
        if($request->ajax()){
            return view('Admin/Node/ajax',['data'=>$data,'p'=>$p,'newpage'=>$num]);
        }
        return view('Admin/Node/show',['data'=>$data,'p'=>$p,'newpage'=>$num]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin/Node/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Nodeinsert $request)
    {
        $arr = $request->except('_token');
        $res = DB::table('node')->insert($arr);
        if($res){
            return redirect("/node")->with('success','添加成功');
        } else {
            return back()->with('error','添加失败');
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
        $data = DB::table('node')->where('id','=',$id)->first();
        return view('Admin/Node.update',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Nodeinsert $request, $id)
    {
        var_dump($request->all());
        $arr = $request->except('_token','_method');
        var_dump($arr);
        $res = DB::table('node')->where('id','=',$id)->update(['cname'=>$arr['cname'],'fname'=>$arr['fname']]);
        if($res){
            return redirect("/node")->with('success','修改成功');
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
    
    public function del(Request $request){
        $id = $_GET['id'];
        $result = DB::table('node')->where('id','=',$id)->delete();
        if($result){
            echo 1;
        } else {
             echo 2;
        }
    }
}
