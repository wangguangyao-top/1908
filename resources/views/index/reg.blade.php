@extends('layouts.shop')
@section('title', '首页')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('add')}}" method="post" class="reg-login">
     @csrf
      <h3>已经有账号了？点此<a class="orange" href="{{url('/login')}}">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="admin_tel" class="tel" placeholder="输入手机号码或者邮箱号" /><span style="color:red" class="span_tel"></span></div>
       <div class="lrList2"><input type="text" name="admin_auth" class="auth" placeholder="输入短信验证码" /><button type="button" class="but">获取验证码</button></div>
       <div class="lrList"><input type="text" name="admin_pas" class="pwd" placeholder="设置新密码（6-18位数字或字母）" /><span style="color:red" class="span_pwd"></span></div>
       <div class="lrList"><input type="text" name="admin_pas2" class="pwd2" placeholder="再次输入密码" /><span style="color:red" class="span_pwd2"></span></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" class="obr" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     <script src="/static/jquery.min.js"></script>
     <script> 
     $(function(){
        $(document).on('blur','.tel',function(){
            var tel=$('.tel').val();
            var res=/^(13[0-9]{9})|(15[0-9][0-9]{8})|(18[0-9][0-9]{8})$/;
            var reg=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(substr_count(tel,'@')>=1){
                if(!reg.test(tel)){
                    $('.span_tel').html('邮箱格式不正确');
                    return false;
                }else{
                    $('.span_tel').html('');       
                }
            }else{
                if(!res.test(tel)){
                    $('.span_tel').html('手机格式不正确');
                    return false;
                }else{
                    $('.span_tel').html('');
                }
            }
        })
        $(document).on('click','.but',function(){
            var tel=$('.tel').val();
            var res=/^[0-9]{11,}$/;
            if(!res.test(tel)){
                $('.span_tel').html('手机格式不正确');
                return false;
            }else{
                $('.span_tel').html('');
            }
            $.ajax({
                type:'post',
                url:"{{url('show')}}",
                data:{tel:tel,_token:'{{csrf_token()}}'},
                dataType:'json',
                success:function(info){
                   if(info.sess==200){
                       alert(info.msg);
                   }
                }
                
            })
            $('.but').text('60s后发送');
            set=setInterval(setTime,1000);
        })
        $(document).on('click','.obr',function(){
            var tel=$('.tel').val();
            var trl=true;
            var res=/^[0-9]{11,}$/;
            if(!res.test(tel)){
                $('.span_tel').html('手机格式不正确');
                return false;
            }else{
                $('.span_tel').html('');
            }
            var auth=$('.auth').val();
                auth=parseInt(auth);
            var pwd=$('.pwd').val();
            var pwd2=$('.pwd2').val(); 
            var res2=/^[0-9a-zA-Z]{6,18}$/;
            if(!res2.test(pwd)){
                $('.span_pwd').html('密码格式不正确');
                return false;
            }else{
                $('.span_pwd').html('');
            }
            if(pwd!=pwd2){
                $('.span_pwd2').html('两次密码不一致');
                return false;
            }else{
                $('.span_pwd2').html('');
            }
            // $.ajax({
            //     type:'post',
            //     url:"{{url('/sess')}}",
            //     data:{tel:tel,_token:'{{csrf_token()}}'},
            //     dataType:'json',
            //     async:false,
            //     success:function(info){
            //         // alert(info.tel);
            //         if(info.tel!=tel){
            //             alert('账号不一致');
            //             trl=false
            //         }
            //         if((time()-info.user_time)>300){
            //             alert('验证码已超过5分钟');
            //             trl=false
            //         }
            //         if(info.code2==auth){
            //             alert('验证码不正确');
            //             trl=false
            //         }
            //     }
            // })
            // if(!trl){
            //     return false;
            // }
        }) 
//倒计时
        function setTime(){
            var but=$('.but').text();
            var setime=parseInt(but);
            var setime2=setime-1;
            if(setime2==0){
                clearInterval(set);
                $('.but').text('获取验证码'); 
                $('.but').css('pointer-events','auto');
            }else{
                $('.but').text((setime2+"s")+'后发送');
                $('.but').css('pointer-events','none');
            }
           
        }      
     })
    </script>
@endsection

