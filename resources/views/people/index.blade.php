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
    <input type="text" name="username" value="{{$username}}" placeholder="搜索名称">
    <select name="is_hubei">
        <option value="">--请选择--</option>
        <option value="1" @if($is_hubei==1) selected @endif>是湖北人</option>
        <option value="2"  @if($is_hubei==2) selected @endif>不是湖北人</option>
    </select> 
    <button>搜索</button>
</form>
<table class="table" >
	<caption>上下文表格布局</caption>
	<thead>
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
	</thead>
	<tbody>
    @foreach($data as $k=>$v)
		<tr @if($k%2==0)class="active"@else class="danger" @endif>
			<td>{{$v->p_id}}</td>
            <td>{{$v->username}}</td>
			<td>{{$v->age}}</td>            
            <td>{{$v->card}}</td>
            <td>{{$v->is_hubei==1?'√':'×'}}</td>
            <td><img src="{{env('PICTURE_URL')}}{{$v->head}}" height="100px"></td> <!-- env()是函数 .env文件夹  -->
            <td>{{date("Y-m-d H:i:s",$v->add_time)}}</td>
            <td> 
                <a href="{{url('/people/edit7').'/'.$v->p_id}}" type="button" class="btn btn-info">修改</a>&nbsp;&nbsp;
                <a href="{{url('people/destroy2').'/'.$v->p_id}}"  class="btn btn-danger">删除</a>
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