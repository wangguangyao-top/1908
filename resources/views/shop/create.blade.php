<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>添加页面</h1></center>
@if ($errors->any())
	<div class="alert alert-danger"> 
		<ul> 
			@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
<form action="{{url('shop/store')}}" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
    @csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">名字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="username" id="firstname" 
				   placeholder="请输入名字"><b style="color:red">{{$errors->first('username')}}</b>
		</div>
    </div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">年龄</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="age" id="firstname" 
				   placeholder="请输入年龄"><b>{{$errors->first('age')}}</b>
		</div>
    </div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">身份证号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="card" id="firstname" 
				   placeholder="请输入身份证">
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否是湖北人</label>
		<div class="col-sm-10">
            <label class="checkbox-inline">
                <input type="radio" id="inlineCheckbox1" name="is_hubei" value="1"> 是
            </label>
            <label class="checkbox-inline">
                <input type="radio" id="inlineCheckbox2" name="is_hubei" value="2"> 否
            </label>
		</div>
    </div>
   
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">头像</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="head" id="lastname">
		</div>
    </div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>