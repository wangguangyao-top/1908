<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<script src="/static/js/jquery.min.js"></script>
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<body>
    <form>
        <input type="text" name="e_name" value="{{$e_name}}">
        <select name="c_id">
            <option value="">--请选择--</option>
        @foreach($data2 as $v)
            <option @if($v->c_id==$c_id) selected @endif value="{{$v->c_id}}">{{$v->c_name}}</option>
        @endforeach
        </select>
        <button>搜索</button>
    </form>
    <table border>
        <tr>
            <td>编号</td>
            <td>文章标题</td>
            <td>文章分类</td>
            <td>文章重要性</td>
            <td>是否显示</td>
            <td>添加日期</td>
            <td>操作</td>
        </tr>
        @foreach($data as $k=>$v)
        <tr>
            <td>{{$v->e_id}}</td>
            <td>{{$v->e_name}}</td>
            <td>{{$v->c_name}}</td>
            <td>{{$v->significance==1?'普通':'重要'}}</td>
            <td>{{$v->show==1?'√':'×'}}</td>
            <td>{{date("Y-m-d H:i:s",$v->e_time)}}</td>
            <td>
                <a href="{{url('wenzang/edit')}}/{{$v->e_id}}">修改</a>
                <button type="button" class="but" e_id="{{$v->e_id}}">删除</button>
            </td>
        </tr>
        @endforeach
    </table>
    {{$data->appends(['e_name'=>$e_name,'c_id'=>$c_id])->links()}}
</body>
</html>
<script>
    $(function(){
        $(document).on('click','.but',function(){
          var _this=$(this);
          var e_id=_this.attr('e_id');
        if(confirm('是否删除')){
            $.ajax({
              type:'post',
              url:"{{url('wenzang/destroy')}}",
              data:{e_id:e_id,_token:'{{csrf_token()}}'},
              dataType:'json',
              success:function(info){
                  if(info.ses==200){
                        location.href="{{url('wenzang/index')}}";
                    }
              }
            })
        }
    })
    })
</script>