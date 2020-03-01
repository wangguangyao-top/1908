<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods_class;
class goodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo 123;
        $where=[
            ['goods_del','=',1]
        ];
        $data=Goods_class::where($where)->get();
        $ass=getinfo($data);
        return view('goods.index',['ass'=>$ass]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $where=[
            ['goods_del','=',1]
        ];
        $data=Goods_class::where($where)->get();
        $ass=getinfo($data);
        return view('goods.create',['ass'=>$ass]);
    }
    public function goods_sole(){
        $goods_classname=request()->goods_classname;
        $where=[];
        if(!empty($goods_classname)){
            $where[]=['goods_classname','=',$goods_classname];
            $data=Goods_class::where($where)->count();
            if($data){
                return ['ses'=>200,'msg'=>'分类名称已存在','ind'=>$data];
            }else{
                return ['ses'=>2,'msg'=>'ok','ind'=>$data];
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        $add=Goods_class::insert($data);
        if($add){
            return redirect('goods/index');
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
        $where=[
            ['goods_del','=',1]
        ];
        $data=Goods_class::where($where)->get();
        $ass=getinfo($data);
        $data2=Goods_class::where('goods_classid',$id)->first();
        return view('goods/edit',['ass'=>$ass,'data2'=>$data2]);
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
    $data=$request->except('_token');
    $data4=Goods_class::where('p_id',$id)->count();
    if($data4>0){
        echo "<script>alert('此分类下还有子id')</script>";
        die;
    }else{
        $data2=Goods_class::where('goods_classid',$id)->update($data);
        if($data2==1 || $data2==0){
            return redirect('goods/index');
        }
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
        $goods_del=request()->goods_del;
        $data4=Goods_class::where('p_id',$id)->count();
        if($data4>0){
            return ['ses'=>4,'msg'=>'此分类下还有子id'];
        }else{
            $data=Goods_class::where('goods_classid',$id)->update(['goods_del'=>2]);
            if($data){
                return ['ses'=>200,'msg'=>'删除成功'];
            }else{
                return ['ses'=>2,'msg'=>'删除失败'];
            }
        }
    }
}
