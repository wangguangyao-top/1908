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
    <form action="{{url('goodsdo/store')}}" method="post" enctype="multipart/form-data" method="post">
    @csrf
        <table>
            <tr>
                <td>商品名称</td>
                <td><input type="text" name="goods_name"></td>            
            </tr>
            <tr>
                <td>分类名称</td>
                <td>
                    <select name="goods_classid">
                        <option value="">--请选择--</option>
                    @foreach($class2 as $k=>$v)
                        <option value="{{$v->goods_classid}}">{{str_repeat('——|',$v->leval).$v->goods_classname}}</option>
                    @endforeach
                    </select>
                </td>            
            </tr>
            <tr>
                <td>商品描述</td>
                <td>
                    <textarea name="goods_data" cols="30" rows="3"></textarea>
                </td>            
            </tr>
            <tr>
                <td>商品价格</td>
                <td><input type="text" name="goods_price"></td>            
            </tr>
            <tr>
                <td>商品图片</td>
                <td><input type="file" name="goods_img"></td>            
            </tr>
            <tr>
                <td>品牌</td>
                <td>
                    <select name="brand_id">
                        <option value="">--请选择--</option>
                    @foreach($brand as $vv)
                        <option value="{{$vv->brand_id}}">{{$vv->brand_name}}</option>  
                    @endforeach                  
                    </select>
                </td>            
            </tr>
            <tr>
                <td>是否精品</td>
                <td>
                    <input type="radio" name="is_com" value="1">是
                    <input type="radio" name="is_com" value="2">否                    
                </td>            
            </tr>
            <tr>
                <td>是否热卖</td>
                <td>
                    <input type="radio" name="is_sell" value="1">是
                    <input type="radio" name="is_sell" value="2">否
                </td>            
            </tr>
            <tr>
                <td>商品相册</td>
                <td>
                    <input type="file" name="goods_imgs[]" multiple="multiple">
                </td>            
            </tr>
            <tr>
                <td>商品库存</td>
                <td>
                    <input type="text" name="goods_repertory">           
                </td>            
            </tr>
            <tr>
                <td></td>
                <td><button>添加</button></td>            
            </tr>
        </table>
    </form>
</body>
</html>