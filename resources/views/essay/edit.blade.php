<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>修改</title>
</head>
<meta name="csrf-token" content="{{csrf_token()}}">
<script src="/static/js/jquery.min.js"></script>
<body>
    <form action="{{url('/wenzang/update/'.$essay->e_id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <table>
            <tr>
                <td>文章标题</td>
                <td><input type="text" name="e_name" value="{{$essay->e_name}}"><span class="span_name">*</span></td>
            </tr>
            <tr>
                <td>文章分类</td>
                <td>
                    <select name="c_id">
                        <option value="">--请选择--</option>
                    @foreach($data as $k=>$v)
                        <option @if($v->c_id==$essay->c_id) selected @endif value="{{$v->c_id}}">{{$v->c_name}}</option>
                    @endforeach
                    </select><span class="span_id">*</span>
                </td>
            </tr>
            <tr>
                <td>文章重要性</td>
                <td>
                    <input type="radio" name="significance" @if($essay->significance==1) checked @endif value="1">普通
                    <input type="radio" name="significance" @if($essay->significance==2) checked @endif value="2">重要
                    <span class="span_zy">*</span>
                </td>
            </tr>
            <tr>
                <td>是否显示</td>
                <td>
                    <input type="radio" name="show" @if($essay->show==1) checked @endif value="1">是
                    <input type="radio" name="show" @if($essay->show==2) checked @endif value="2">否
                    <span class="span_show">*</span>
                </td>
            </tr>
            <tr>
                <td>文章作者</td>
                <td>
                    <input type="text" name="author" value="{{$essay->author}}"><span class="author">*</span>
                </td>
            </tr>
            <tr>
                <td>作者email</td>
                <td><input type="text" name="email" value="{{$essay->email}}"></td>
            </tr>
            <tr>
                <td>关键字</td>
                <td><input type="text" name="e_key" value="{{$essay->e_key}}"></td>
            </tr>
            <tr>
                <td>网页描述</td>
                <td><textarea name="describe">{{$essay->describe}}</textarea></td>
            </tr>
            <tr>
                <td>上传文件</td>
                <td><img src="{{env('PICTURE_URL')}}{{$essay->e_file}}" height="50px"><input type="file" name="e_file"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="button" class="but" e_id="{{$essay->e_id}}">修改</button></td>
            </tr>
        </table>
    </form>
</body>
</html>
<script>
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
    $(function(){
        $(document).on('blur','[name=e_name]',function(){
            var e_name=$('[name=e_name]').val();
            var res=/^[\u4e00-\u9fa5a-zA-Z0-9_]+$/;
            if(!res.test(e_name)){
                $('.span_name').html('文章标题是由中文，字母，数字，下划线组成');
                return false
            }else{
                $('.span_name').html('');
            }
            $.ajax({
                type:'post',
                url:"/wenzang/sole",
                data:{e_name:e_name,e_id:e_id},
                dataType:'json',
                success:function(info){
                    if(info.ind>0){
                        $('.span_name').html(info.msg);
                    }
                }
            })
        })
        $(document).on('blur','[name=author]',function(){
            var author=$('[name=author]').val();
            var res=/^[\u4e00-\u9fa5a-zA-Z]{2,8}$/;
                if(res.test(author)==false){
                    $('.author').html('文章作者是由中文，字母，2-8位，下划线组成');
                    return false;
                }else{
                    $('.author').html('');
                }
        })
        $(document).on('blur','[name=c_id]',function(){
            var c_id=$('[name=c_id]').val();
            if(c_id==''){
                $('.span_id').html('文章分类必选');
                return false;
            }else{
                $('.span_id').html('');
            }
        })
        $(document).on('blur','[name=significance]',function(){
            var significance=$('[name=significance]:checked').val();
            if(significance==null){
                $('.span_zy').html('文章重要性必选');
                return false;
            }else{
                $('.span_zy').html('');
            }
        })
        $(document).on('blur','[name=show]',function(){
            var show=$('[name=show]:checked').val();
            if(show==null){
                $('.span_show').html('文章是否必选');
                return false;
            }else{
                $('.span_show').html('');
            }
        })
        $(document).on('click','.but',function(){
            var e_name=$('[name=e_name]').val();
            var e_id=$(this).attr('e_id');
            var titleflag=true;
            var res=/^[\u4e00-\u9fa5a-zA-Z0-9_]+$/;
            if(!res.test(e_name)){
                $('.span_name').html('文章标题是由中文，字母，数字，下划线组成');
                return false
            }else{
                $('.span_name').html('');
            }
            $.ajax({
                type:'post',
                url:"/wenzang/sole",
                data:{e_name:e_name,e_id:e_id},
                async:false,
                dataType:'json',
                success:function(info){
                    if(info.ind>0){
                        $('.span_name').html(info.msg);
                        titleflag=false;
                    }
                }
            })
            if(!titleflag){
                return false;
            }
            var c_id=$('[name=c_id]').val();
            if(c_id==''){
                $('.span_id').html('文章分类必选');
                return false;
            }else{
                $('.span_id').html('');
            }
            var significance=$('[name=significance]:checked').val();
            if(significance==null){
                $('.span_zy').html('文章重要性必选');
                return false;
            }else{
                $('.span_zy').html('');
            }
            var show=$('[name=show]:checked').val();
            if(show==null){
                $('.span_show').html('文章是否必选');
                return false;
            }else{
                $('.span_show').html('');
            }
            var author=$('[name=author]').val();
            var res=/^[\u4e00-\u9fa5a-zA-Z]{2,8}$/;
            if(res.test(author)==false){
                $('.author').html('文章作者是由中文，字母，2-8位，下划线组成');
                return false;
            }else{
                $('.author').html('');
            }
            $('form').submit();
        })
    })
</script>