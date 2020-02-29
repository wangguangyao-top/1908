<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=s, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<script src="/static/js/jquery.min.js"></script>
<body>
    <form action="{{url('goodsdo/update').'/'.$goods->goods_id}}" method="post" enctype="multipart/form-data" method="post">
    @csrf
        <table>
            <tr>
                <td>商品名称</td>
                <td><input type="text" name="goods_name" value="{{$goods->goods_name}}"></td>            
            </tr>
            <tr>
                <td>分类名称</td>
                <td>
                    <select name="goods_classid">
                        <option value="">--请选择--</option>
                    @foreach($class2 as $k=>$v)
                        <option @if($goods->goods_classid==$v->goods_classid) selected @endif value="{{$v->goods_classid}}">{{str_repeat('——|',$v->leval).$v->goods_classname}}</option>
                    @endforeach
                    </select>
                </td>            
            </tr>
            <tr>
                <td>商品描述</td>
                <td>
                    <textarea name="goods_data" cols="30" rows="3">{{$goods->goods_data}}</textarea>
                </td>            
            </tr>
            <tr>
                <td>商品价格</td>
                <td><input type="text" name="goods_price" value="{{$goods->goods_price}}"></td>            
            </tr>
            <tr>
                <td>商品图片</td>
                <td><img src="{{env('PICTURE_URL')}}{{$goods->goods_img}}" height="100px"><input type="file" name="goods_img"></td>            
            </tr>
            <tr>
                <td>品牌</td>
                <td>
                    <select name="brand_id">
                        <option value="">--请选择--</option>
                    @foreach($brand as $vv)
                        <option @if($goods->brand_id==$vv->brand_id) selected @endif value="{{$vv->brand_id}}">{{$vv->brand_name}}</option>  
                    @endforeach                  
                    </select>
                </td>            
            </tr>
            <tr>
                <td>是否精品</td>
                <td>
                    <input type="radio" @if($goods->is_com==1) checked @endif name="is_com" value="1">是
                    <input type="radio" @if($goods->is_com==2) checked @endif name="is_com" value="2">否                    
                </td>            
            </tr>
            <tr>
                <td>是否热卖</td>
                <td>
                    <input type="radio" @if($goods->is_sell==1) checked @endif name="is_sell" value="1">是
                    <input type="radio" @if($goods->is_sell==2) checked @endif is_sell name="is_sell" value="2">否
                </td>            
            </tr>
            <tr>
                <td>商品相册</td>
                <td>
                @if($goods->goods_imgs)
                    @php $goods_imgs=explode('|',$goods->goods_imgs); @endphp
                    @foreach($goods_imgs as $k1=>$v1)
                        <img src="{{env('PICTURE_URL')}}{{$v1}}" height="100px">
                    @endforeach
                @endif
                    <input type="file" name="goods_imgs[]" multiple="multiple">
                </td>            
            </tr>
            <tr>
                <td>商品库存</td>
                <td>
                    <input type="text" value="{{$goods->goods_repertory}}" name="goods_repertory">           
                </td>      
            </tr>
            <tr>
                <td></td>
                <td><button>修改</button></td>            
            </tr>
        </table>
    </form>
</body>
</html>
</body>
</html>