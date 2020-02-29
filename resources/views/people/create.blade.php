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
<form action="{{url('people/store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
    @csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">名字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="username"
				   placeholder="请输入名字"><b style="color:red">{{$errors->first('username')}}</b>
		</div>
    </div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">年龄</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="age" id="firstname" 
				   placeholder="请输入年龄"><b style="color:red">{{$errors->first('age')}}</b>
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
            </label><b style="color:red">{{$errors->first('is_hubei')}}</b>
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
<script>
	// $(function(){
	// 	$(document).on('blur','[name=username]',function(){
	// 		var user=$('[name=username]').val();
	// 		var reg=/^[\u4e00-\u9fa5a-zA-Z0-9_-]{2,12}$/
	// 		if(!reg.test(user)){
	// 			$('.span_name').html('名称由中文,字母，数字，下划线，长度2-12位组成');
	// 			return false;
	// 		}else{
	// 			$('.span_name').html('');
	// 		}
	// 	})

	// 	 $(document).on('blur','[name=age]',function(){
	// 		var age=$('[name=age]').val();
	// 		var ages=/^[0-9]{1,150}$/;
	// 		if(!ages.test(age)){
	// 			$('.span_age').html('年龄必须是数字1-150岁');
	// 			return false;
	// 		}else{
	// 			$('.span_age').html('');
	// 		}
	// 	 })
	// 	// $(document).on('click','.btn',function(){
			
	// 	// })
	// 	$(document).on('click','.btn',function(){
	// 		var flag=true;
	// 		var user=$('[name=username]').val();
	// 		var reg=/^[\u4e00-\u9fa5a-zA-Z0-9_-]{2,12}$/
	// 		if(!reg.test(user)){
	// 			$('.samp_name').html('名称由中文,字母，数字，下划线，长度2-12位组成');
	// 			return false;		
	// 		}else{
	// 			$('.samp_name').html('');
	// 		}
	// 	})
	// })
</script>