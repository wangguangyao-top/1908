<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Bootstrap 实例 - 上下文类</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>展示页面</h1></center>
<table class="table" border="1">
    @csrf
         <tr>
            <th>ID</th>
			<th>商品名称</th>
			<th>分类名称</th>
            <th>商品描述</th>
            <th>商品价格</th>
			<th>商品图片</th>
			<th>品牌</th>
            <th>是否精品</th>
            <th>是否热卖</th>
			<th>商品相册</th>
			<th>货物单号</th>
            <th>商品库存</th>
            <th>操作</th>
		</tr>
    @foreach($data as $k=>$v)
        <tr>
            <th>{{$v->goods_id}}</th>
            <th>{{$v->goods_name}}</th>
			<th>{{$v->goods_classname}}</th>
			<th>{{$v->goods_data}}</th>
            <th>{{$v->goods_price}}</th>
            <th><img src="{{env('PICTURE_URL')}}{{$v->goods_img}}" height="100px"></th>
			<th>{{$v->brand_name}}</th>
			<th>{{$v->is_com==1?'是':'否'}}</th>
            <th>{{$v->is_sell==1?'是':'否'}}</th>
            <th>
            @if($v->goods_imgs)
                @php $imgs=explode('|',$v->goods_imgs); @endphp
                @foreach($imgs as $vv)
                    <img src="{{env('PICTURE_URL')}}{{$vv}}" height="100px">
                @endforeach
            @endif
            </th>
			<th>{{$v->goods_plare}}</th>
			<th>{{$v->goods_repertory}}</th>
            <th>
                <a href="{{url('goodsdo/edit').'/'.$v->goods_id}}">修改</a>
                <a href="{{url('goodsdo/destroy').'/'.$v->goods_id}}">删除</a>
            </th>
		</tr>
    @endforeach
</table>
{{$data->links()}}
</body>
</html>
<script>
    // $(function(){
    //     $(document).on('click','.but',function(){
    //         var _this=$(this);
    //         var goods_id=$(this).attr('goods_id');
    //         var goods_del=$(this).parents('tr').attr('goods_del');
    //     if(confirm('是否删除')){
    //         $.ajax({
    //             type:'post',
    //             url:"{{url('goods/destroy')}}/"+goods_id,
    //             data:{goods_del:goods_del,_token:'{{csrf_token()}}'},
    //             dataType:'json',
    //             success:function(info){
    //                 if(info.ses==4){
    //                     alert(info.msg);
    //                 }
    //                 if(info.ses==200){
    //                     location.href="{{url('goods/index')}}";
    //                 }         
    //             }
    //         })
    //     }            
    //     })
    // })
</script>
</body>
</html>