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
<form>
    <div class="form-group">
		<div class="col-sm-3">
			<input type="text" class="form-control" value="{{$username}}" name="username" id="firstname" 
                   placeholder="请输入名字">
        </div>
        <button class="btn btn-success">搜索</button>        
    </div>
 </form>
<table class="table">
         <tr>
            <th>ID</th>
			<th>姓名</th>
			<th>年龄</th>
            <th>身份证</th>
            <th>是否是湖北人</th>
            <th>头像</th>
            <th>时间</th>
            <th>操作</th>
		</tr>
    @foreach($find as $k=>$v)
		<tr @if($k%2==0)class="warning" @else  class="danger" @endif>
			<td>{{$v->p_id}}</td>
			<td>{{$v->username}}</td>
            <td>{{$v->age}}</td>
            <td>{{$v->card}}</td>
            <td>{{$v->is_hubei==1?'√':'×'}}</td>
            <td>@if($v->head)<img src="{{env('PICTURE_URL')}}{{$v->head}}" height="100px" while="100px">@endif</td>
            <td>{{date("Y-m-d H:i:s",$v->add_time)}}</td>
            <td>
                <a href="{{url('shop/edit').'/'.$v->p_id}}" class="btn btn-warning">修改</a>
                <a href="{{url('shop/destroy8').'/'.$v->p_id}}" class="btn btn-danger">删除</a>
            </td>
        </tr>
    @endforeach
    <tr><td>{{$find->appends(['username'=>$username])->links()}}</td></tr>
</table>
</body>
</html>