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
	<thead>
         <tr>
            <th>ID</th>
			<th>学生姓名</th>
			<th>学生性别</th>
            <th>班级名称</th>
            <th>成绩</th>
            <th>操作</th>
		</tr>
	</thead>
	<tbody>
    @foreach($data as $k=>$v)
		<tr @if($k%2==0)class="warning" @else  class="danger" @endif>
			<td>{{$v->s_id}}</td>
			<td>{{$v->s_name}}</td>
            <td>{{$v->s_sex==1?'男':'女'}}</td>
            <td>
                @if($v->s_class==1) 1907php @endif
                @if($v->s_class==2) 1908php @endif
                @if($v->s_class==3) 1909php @endif
            </td>
            <td>{{$v->s_chengji}}</td>
            <td>
                <a href="{{url('students/edit').'/'.$v->s_id}}" class="btn btn-warning">修改</a>
                <a href="{{url('/destroy').'/'.$v->s_id}}" class="btn btn-danger">删除</a>
            </td>
        </tr>
    @endforeach
        <tr>
            <td>{{$data->links()}}</td>
        </tr>
	</tbody>
</table>
</body>
</html>