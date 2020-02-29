<?php

namespace App\Http\Controllers\index;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Goodsdo;
use App\Details;
class ProInfo extends Controller
{
    function proinfo($id){
        // Redis::flushall();
        $goods_id=request()->id;    
        $xx=Redis::setnx('xx_'.$id,1);
        if(!$xx){
            $xx=Redis::incr('xx_'.$id);
        }
        echo $xx;
        $goods=Goodsdo::where('goods_id',$goods_id)->first();
        return view('index.proinfo',['goods'=>$goods]);
    }
    function add_details(){
        $goods_id=request()->goods;
        $d_amount=request()->amount;
        if(empty($d_amount) && empty($goods_id)){
            return ['sess'=>'2','msg'=>'数据有误'];
        }
        $data2=Details::where('goods_id','=',$goods_id)->count();
        if($data2>=1){
            $data3=Details::where('goods_id','=',$goods_id)->value('d_amount');
            $data4=Details::where('goods_id','=',$goods_id)->update(['d_amount'=>$data3+$d_amount,'d_time'=>time()]);
        }else{
            $add=['goods_id'=>$goods_id,'d_amount'=>$d_amount,'d_time'=>time()];
            $data=Details::insert($add);
        }
        return ['sess'=>'200','msg'=>'加入购物车成功'];
    }
}
