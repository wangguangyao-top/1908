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
<center><h1>展示</h1></center>
<form>
    <input type="text" name="user_name">
    <button>搜索</button>
</form>
<table class="table" >
	<caption>上下文表格布局</caption>
	<thead>
		<tr>
            <th>ID</th>
			<th>用户名</th>
            <th>手机号</th>
            <th>图像</th>
            <th>邮箱</th>
            <th>操作</th>
		</tr>
	</thead>
	<tbody>
    @foreach($data as $v)
		<tr>
            <th>{{$v->user_id}}</th>
			<th>{{$v->user_name}}</th>
            <th>{{$v->user_tel}}</th>
            <th><img src="{{env('PICTURE_URL')}}{{$v->user_img}}" height="100px"></th>
            <th>{{$v->user_text}}</th>
            <th>
                <a href="{{url('/login/edit').'/'.$v->user_id}}" type="button" class="btn btn-info">修改</a>&nbsp;&nbsp;
                <a href="{{url('login/destroy').'/'.$v->user_id}}"  class="btn btn-danger">删除</a>
            </th>
        </tr>
    @endforeach
	</tbody>
</table>
{{$data->links()}}
</body>
</html>