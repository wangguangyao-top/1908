<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goodsdo;
use App\Details;
use DB;
class car extends Controller
{
    function index(){
        // $details=Details::get();  
        // foreach($details as $v){
        //     $goods_id[]=$v['goods_id'];
        // }
        // // $goods_id2=implode(',',$goods_id);
        //  foreach($goods_id as $kk=>$vv){
        //     $goods[]=Goodsdo::where('goods_id','=',$vv)->get();  
        //  }
        $goods = Details::leftjoin('goods','details.goods_id','=','goods.goods_id')->get();
        return view('index/car',['goods'=>$goods]);
    }
}
