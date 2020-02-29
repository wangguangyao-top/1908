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
<table class="table">
         <tr>
            <th>ID</th>
			<th>分类名称</th>
			<th>分类详情</th>
            <th>操作</th>
		</tr>
    @foreach($ass as $k=>$v)
        <tr goods_del="{{$v->goods_del}}">
            <th>{{$v->goods_classid}}</th>
			<th>{{str_repeat('——&|',$v['leval']).$v->goods_classname}}</th>
			<th>{{$v->goods_classtext}}</th>
            <th>
                <a href="{{url('goods/edit')}}/{{$v->goods_classid}}">修改</a>
                <button type="button" class="but" goods_id="{{$v->goods_classid}}" style="color:red">删除</button>
            </th>
		</tr>
    @endforeach
</table>
</body>
</html>
<script>
    $(function(){
        $(document).on('click','.but',function(){
            var _this=$(this);
            var goods_id=$(this).attr('goods_id');
            var goods_del=$(this).parents('tr').attr('goods_del');
        if(confirm('是否删除')){
            $.ajax({
                type:'post',
                url:"{{url('goods/destroy')}}/"+goods_id,
                data:{goods_del:goods_del,_token:'{{csrf_token()}}'},
                dataType:'json',
                success:function(info){
                    if(info.ses==4){
                        alert(info.msg);
                    }
                    if(info.ses==200){
                        location.href="{{url('goods/index')}}";
                    }         
                }
            })
        }            
        })
    })
</script>