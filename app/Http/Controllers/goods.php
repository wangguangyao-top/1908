<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Goods_class;
use App\Brand;
use App\Goodsdo;
class goods extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $page2=request()->page??'1';
        $data=cache('data'.$page2);
        if(!$data){
            echo 'db';
            $page=config('app.page');
            $data=Goodsdo::join('brand','brand.brand_id','=','goods.brand_id')->join('goods_class','goods_class.goods_classid','=','goods.goods_classid')->paginate($page);
            cache(['data'.$page2=>$data],3600);
        }
        return view('goodsdo.index',['data'=>$data]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $brand=Brand::get();
        $goods_class=Goods_class::where('goods_del',1)->get();
        $class2=getinfo($goods_class);
        return view('goodsdo.create',['class2'=>$class2,'brand'=>$brand]);
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
        $data=$request->except('_token');
        
        if($request->hasFile('goods_img')){
            $data['goods_img']=uploads('goods_img');
        }
         
        if($request->hasFile('goods_imgs')){
            $data['goods_imgs']=uploads2('goods_imgs');   
        }
        $data['goods_plare']=date("Ymd").rand(1,10000);
        $data4=Goodsdo::insert($data);
        if($data4){
            return redirect('/goodsdo/index');
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
        //
        $class2=Goods_class::all();
        $data=$this->infinite($class2);
        $brand=Brand::all();
        $goods=Goodsdo::where('goods_id',$id)->first();
        return view('goodsdo/edit',['class2'=>$data,'brand'=>$brand,'goods'=>$goods]);
    }
    public function infinite($data,$p_id=0,$leval=0){
        static $arr=[];
        foreach($data as $k=>$v){
            if($v->p_id==$p_id){
                $v->leval=$leval;
                $arr[]=$v;
                $this->infinite($data,$v->goods_classid,$leval+1);
            }
        }
        return $arr;
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
       if ($request->hasFile('goods_img')) {
            $data['goods_img']=$this->uploads('goods_img');
       }
       if ($request->hasFile('goods_imgs')) {
            $data['goods_imgs']=$this->uploads2('goods_imgs');
        }
        $data4=Goodsdo::where('goods_id',$id)->update($data);
        if($data4==1 || $data4==0){
            return redirect('goodsdo/index');
        }
    }
    public function uploads($file){
        if(!$file){
            return;
        } 
        if(request()->file($file)->isValid()){
            $photo = request()->file($file);
            $store_result = $photo->store('images');
            return $store_result;
        }
    }

    public function uploads2($file){
        $photo = request()->file($file);
        if(!is_array($photo)){  //is_array 判断是否是数组
            return;
        } 
            foreach($photo as $v){
                $store_result[]= $v->store('images');
            }
            $store_result=implode('|',$store_result);
            return $store_result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Goodsdo::destroy($id);
        if($data){
            return redirect('goodsdo/index');
        }else{
            echo "<script>alert(删除失败)</script>";
        }
    }
}
