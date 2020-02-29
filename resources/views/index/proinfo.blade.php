@extends('layouts.shop')
@section('title', '详情')
@section('content')
<div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
     @php $img=explode('|',$goods->goods_imgs); @endphp
     @foreach($img as $k=>$v)
      <img src="{{env('PICTURE_URL')}}{{$v}}"/>
     @endforeach
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">￥{{$goods->goods_price}}</strong></th>
       <td>
        <span class="max">＋</span>
        <input type="text" size="3" value="1" name="d_amount" class="amount"/>
        <span class="min">－</span>
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$goods->goods_name}}</strong>
        <p class="hui">富含纤维素，平衡每日膳食</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
     {{$goods->goods_data}}
      <img src="{{env('PICTURE_URL')}}{{$goods->goods_img}}" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><button class="but">加入购物车</button></td>
      </tr>
     </table>
    <script>
        $(document).on('blur','.amount',function(){
            var amount=$(this).val();
            var inv="{{$goods->goods_inv}}";
            var goods="{{$goods->goods_id}}";
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
            var inv="{{$goods->goods_inv}}";
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
        $(document).on('click','.but',function(){
            var amount=$('.amount').val();
            var goods="{{$goods->goods_id}}";
            if(!goods){
                return false;
            }
        if(confirm('加入购物车成功是否结算')){
            $.ajax({
                type:'post',
                url:"{{url('add_details')}}",
                data:{amount:amount,goods:goods,_token:'{{csrf_token()}}'},
                dataType:'json',
                success:function(info){
                    if(info.sess==200){
                        location.href="{{url('index/car')}}";
                    }else{
                        alert(info.msg);
                    }
                }
            });
        }
            return false;
        })
    </script>
@endsection
