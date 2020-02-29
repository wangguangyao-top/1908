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

<form class="form-horizontal" action="{{url('goods/update')}}/{{$data2->goods_classid}}" role="form" method="post">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" name="goods_classname" value="{{$data2->goods_classname}}" id="firstname" 
				   placeholder="请输入名称">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">分类</label>
		<div class="col-sm-10">
			<select name="p_id">
                <option value="">--请选择--</option>
			@foreach($ass as $k=>$v)
                <option @if($data2->p_id==$v->goods_classid) selected @endif value="{{$v->goods_classid}}">{{str_repeat('——&|',$v['leval']).$v->goods_classname}}</option>
			@endforeach
            </select>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类详情</label>
		<div class="col-sm-10">
            <textarea name="goods_classtext" cols="80" rows="2" placeholder="请输入详情">{{$data2->goods_classtext}}</textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>