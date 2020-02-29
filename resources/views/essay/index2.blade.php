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
<table class="table" >
	<thead>
        <tr>
            <td>编号</td>
            <td>文章标题</td>
            <td>文章分类</td>
            <td>文章重要性</td>
            <td>是否显示</td>
            <td>添加日期</td>
        </tr>
	</thead>
	<tbody>
        @foreach($data4 as $k=>$v)
        <tr>
            <td>{{$v->e_id}}</td>
            <td>{{$v->e_name}}</td>
            <td>{{$v->c_name}}</td>
            <td>{{$v->significance==1?'普通':'重要'}}</td>
            <td>{{$v->show==1?'√':'×'}}</td>
            <td>{{date("Y-m-d H:i:s",$v->e_time)}}</td>
        </tr>
        @endforeach
        <tr>
            <td>{{$data4->appends(['e_name'=>$e_name,'c_id'=>$c_id])->links()}}</td>
        </tr>
	</tbody>
</table>
</body>
</html>
<script>
    $(document).on('click','.pagination a',function(){
        var url=$(this).attr('href');
        if(!url){
            return false;
        }
        $.get(url,function(request){
            $('tbody').html(request);
        })
            // $.ajax({
            //     url:url,
            //     success:function(info){
            //         alert(info);
            //         // $('tbody').html(info);
            //     }
            // })
        return false;
    })
</script>