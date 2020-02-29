<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<meta name="csrf-token" content="{{csrf_token()}}">
<body>
<form class="form-horizontal" action="{{url('goods/store')}}" role="form" method="post">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-5">
			<input type="text" class="form-control" name="goods_classname" id="firstname" 
				   placeholder="请输入名称"><span class="span_name">*</span>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">分类</label>
		<div class="col-sm-10">
			<select name="p_id">
                <option value="">--请选择--</option>
			@foreach($ass as $k=>$v)
                <option value="{{$v->goods_classid}}">{{str_repeat('——&|',$v->leval).$v->goods_classname}}</option>
			@endforeach
            </select>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类详情</label>
		<div class="col-sm-10">
            <textarea name="goods_classtext" cols="80" rows="2" placeholder="请输入详情"></textarea>
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
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	$(function(){
		$(document).on('blur','[name=goods_classname]',function(){
 			tel=true;
			var goods_classname=$('[name=goods_classname]').val();
			var res=/^[\u4e00-\u9fa5a-zA-Z0-9]{2,20}$/;
			if(!res.test(goods_classname)){
				$('.span_name').html('分类名称由中文，字母，数字(2-20)组成');
				return false;
			}else{
				$('.span_name').html('');
			}
			$.ajax({
				type:'post',
				url:"{{url('goods/goods_sole')}}",
				data:{goods_classname:goods_classname},
				async:false,
				dataType:'json',
				success:function(info){
					if(info.ind>0){
						$('.span_name').html(info.msg);
						tel=false;	
					}
				}
			})
		if(!tel){
			return false;
		}
		})
		$(document).on('click','.btn',function(){
			var goods_classname=$('[name=goods_classname]').val();
			var tel=true;
			var res=/^[\u4e00-\u9fa5a-zA-Z0-9]{2,20}$/;
			if(!res.test(goods_classname)){
				$('.span_name').html('分类名称由中文，字母，数字(2-20)组成');
				return false;
			}else{
				$('.span_name').html('');
			}
			$.ajax({
				type:'post',
				url:"{{url('goods/goods_sole')}}",
				data:{goods_classname:goods_classname,_token:'{{csrf_token()}}'},
				async:false,
				dataType:'json',
				success:function(info){
					if(info.ind>0){
						$('.span_name').html(info.msg);
						tel=false;
					}
				}
			})
		if(!tel){
			return false;
		}
	})
</script>