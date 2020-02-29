@extends('layouts.shop')
@section('title', '详情')
@section('content')
<div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">2</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
     <div class="dingdanlist">
     @foreach($goods as $k=>$v)
      <table>
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 全选</a></td>
       </tr>
       <tr>
        <td width="4%"><input type="checkbox" name="1" /></td>
        <td class="dingimg" width="15%"><img src="{{env('PICTURE_URL')}}{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间：{{date("Y-m-d H:i:s",$v->d_time)}}</time>
        </td>
        <td align="right" amount2="{{$v->goods_inv}}">
            <span class="max">＋</span>
            <input type="text" size="3" value="{{$v->d_amount}}" name="d_amount"  class="amount"/>
            <span class="min">－</span>
        </td>
       </tr>
       <tr>
        <th colspan="4"><strong class="orange">¥{{$v->d_amount*$v->goods_price}}</strong></th>
       </tr>
      </table>
      @endforeach
     </div><!--dingdanlist/-->
     
     <div class="dingdanlist">
      <table>
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 删除</a></td>
       </tr>
      </table>
     </div><!--dingdanlist/-->
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange">¥</strong></td>
       <td width="40%"><a href="pay.html" class="jiesuan">去结算</a></td>
      </tr>
     </table>
     <script>
         $(document).on('blur','.amount',function(){
            var amount=$(this).val();
            var inv=$(this).parent('td').attr('amount2');
            var reg=/^[0-9]+$/;
            // alert(reg.test(amount));
            if(parseInt(amount)==0){
                amount=1;
                $(this).val(amount);
            }
            if(!reg.test(amount)){
                amount=1;
                $(this).val(amount);
            }
            if(parseInt(amount)>=parseInt(inv)){
                amount=inv;
                $(this).val(amount);
            }
        })
        $(document).on('click','.max',function(){
            var amount=$(this).next().val();
            var inv=$(this).parent('td').attr('amount2');        
                amount=parseInt(amount)+1;             
                $(this).next().val(amount);
                if(parseInt(amount)>=parseInt(inv)){
                    amount=inv;
                    $(this).next().val(amount);
                }
                if(amount==parseInt(inv)){
                    alert('最大库存');                    
                }
        })
        $(document).on('click','.min',function(){
            var amount=parseInt($(this).prev().val());
                amount=amount-1;
                $(this).prev().val(amount);
                if(amount<=1){
                    amount=1;
                    $(this).prev().val(amount);
                }
        })
     </script>
@endsection