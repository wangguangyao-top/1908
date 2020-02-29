<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<script src="/static/js/jquery.min.js"></script>
<body>
    <form action="{{url('login/store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <table>
            <tr>
                <td>用户名</td>
                <td><input type="text" name="user_name"><span class="span_name">*</span></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input type="password" name="user_pwd"><span class="span_pwd">*</span></td>
            </tr>
            <tr>
                <td>手机号</td>
                <td><input type="text" name="user_tel"><span class="span_tel">*</span></td>
            </tr>
            <tr>
                <td>邮箱</td>
                <td><input type="text" name="user_text"><span class="span_text">*</span></td>
            </tr>
            <tr>
                <td>用户头像</td>
                <td><input type="file" name="user_img"></td>
            </tr>
            <tr>
                <td></td>
                <td><button class="but">添加</button></td>
            </tr>
        </table>
    </form>
</body>
</html>
<script>
    $(function(){
        $(document).on('blur','[name=user_name]',function(){    
            var tru=true;   
            var user_name=$('[name=user_name]').val();
            var res=/^[\u4e00-\u9fa5\a-zA-Z0-9]{2,8}$/;
            if(!res.test(user_name)){
                $('.span_name').html('用户名由中文，字母，数字2-8位组成');
                tru=false;
            }else{
                $('.span_name').html('');
            }
            $.ajax({
                type:'post',
                url:"/login/sole",
                data:{user_name:user_name,_token:'{{csrf_token()}}'},
                async:false,
                dataType:'json',
                success:function(info){
                    if(info.date>0){
                        $('.span_name').html(info.msg);
                        tru=false;
                    }else{
                        $('.span_name').html(info.msg);
                    }
                }
            })
        })
        $(document).on('blur','[name=user_pwd]',function(){    
            var tru=true;   
            var user_pwd=$('[name=user_pwd]').val();
            var res2=/^[0-9a-zA-Z_]{6,18}$/;
            if(!res2.test(user_pwd)){
                $('.span_pwd').html('密码由，数字,下划线6-18位组成');
                tru=false;
            }else{
                $('.span_pwd').html('');
            }
        })
        $(document).on('blur','[name=user_tel]',function(){    
            var tru=true;   
            var user_tel=$('[name=user_tel]').val();
            var res3=/^[0-9]{11,}$/;
            if(!res3.test(user_tel)){
                $('.span_tel').html('电话格式不正确');
                tru=false;
            }else{
                $('.span_tel').html('');
            }
        })
        $(document).on('blur','[name=user_text]',function(){     
            var tru=true;
            var user_text=$('[name=user_text]').val();
            var res4=/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
            if(!res4.test(user_text)){
                $('.span_text').html('邮箱格式不正确');
                tru=false;
            }else{
                $('.span_text').html('');
            }
        })
        $(document).on('click','.but',function(){ 
            var tru=true;
            var user_name=$('[name=user_name]').val();
            var res=/^[\u4e00-\u9fa5\a-zA-Z0-9]{2,8}$/;
            if(!res.test(user_name)){
                $('.span_name').html('用户名由中文，字母，数字2-8位组成');
                tru=false;
            }else{
                $('.span_name').html('');
            }
            
            $.ajax({
                type:'post',
                url:"/login/sole",
                data:{user_name:user_name,_token:'{{csrf_token()}}'},
                async:false,
                dataType:'json',
                success:function(info){
                    if(info.date>0){
                        $('.span_name').html(info.msg);
                        tru=false;
                    }
                }
            })
            var user_pwd=$('[name=user_pwd]').val();
            var res2=/^[0-9a-zA-Z_]{6,18}$/;
            if(!res2.test(user_pwd)){
                $('.span_pwd').html('密码由，数字,下划线6-18位组成');
                tru=false;
            }else{
                $('.span_pwd').html('');
            }

            var user_tel=$('[name=user_tel]').val();
            var res3=/^[0-9]{11,}$/;
            if(!res3.test(user_tel)){
                $('.span_tel').html('电话格式不正确');
                tru=false;
            }else{
                $('.span_tel').html('');
            }

            var user_text=$('[name=user_text]').val();
            var res4=/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
            if(!res4.test(user_text)){
                $('.span_text').html('邮箱格式不正确');
                tru=false;
            }else{
                $('.span_text').html('');
            }
                      
            if(tru==false){
                return false;
            }

        })
    })
</script>