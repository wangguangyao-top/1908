<?php

namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Cookie;
use App\Login;
use App\Goodsdo;
//手机发送
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
//邮箱发送
use App\Mail\SenCode;
use Illuminate\Support\Facades\Mail;
class IndexController extends Controller
{
public   function index(){
        // $cookie=request()->cookie('name');
        //$cookie=Cookie::get('name');
       // echo $cookie;
        $goods=Goodsdo::all();
        return view('index/index',['goods'=>$goods]);
    }
/**
 *cookie测试
 */
public  function addcookie(){
        $cookie=cookie('name','wgy1',2);
        return response('cookie测试')->cookie($cookie); 
}
/**
 * 登录
 */
public function login(){
    return view('index.login');
}
public function login2(Request $request){
    $data=$request->except('_token');
    // $data['admin_pas']=decrypt($data['admin_pas']);
    // $data3=decrypt($data3['admin_pas']);
    $where=[
        ['admin_tel','=',$data['admin_tel']]
    ];
    $login=Login::where($where)->first();
    $pwd=decrypt($login['admin_pas']);
    if($pwd==$data['admin_pas']){
        echo '登录成功';
        die;
     }else{
         echo '用户名或密码错误';
     }
}
/**
 * 注册 15030020427
*/
public function reg(){
    return view('index.reg');
}
/**
 * 短信发送
 */

public function show(){
    $tel=request()->tel;
    $code=rand('100000','999999');
    $sen2=$this->sendsms($tel,$code);
    if($sen2['Code']=='OK'){
        session(['tel'=>$tel,'code'=>$code,'user_time'=>time()]);
        request()->session()->save();
        return ['sess'=>200,'msg'=>'OK'];
    }
}
public function sess(){
    $tel2=session('tel');
    $code2=session('code');
    $user_time=session('user_time');
    return ['sess'=>200,'msg'=>'OK','tel2'=>$tel2,'code2'=>$code2,'user_time'=>$user_time];
}
/**
 * 短信添加
 */
public function add(){
    $data=request()->except('_token');
    $tel2=session('tel');
    $code2=session('code');
    $user_time=session('user_time');
    if($data['admin_tel']!=$tel2){
        echo "<script>alert('您输入的验证码手机号不一致')</script>";
        die;
        // return redirect('/reg')->with('msg','您输入的验证码手机号不一致');
    }
    if($data['admin_auth']!=$code2){
        echo "<script>alert('您输入的验证码不正确')</script>";
        die;
        // return redirect('/reg')->with('msg','您输入的验证码不正确');
    }
    if((time()-$user_time)>=300){
        echo "<script>alert('验证码超过5分钟')</script>";
        die;
        // return redirect('/reg')->with('msg','验证码超过5分钟');
    }
    if($data['admin_pas']!=$data['admin_pas2']){
        echo "<script>alert('密码不一致')</script>";
        die;
        // return redirect('/reg')->with('msg','密码不一致');
    }
    $data['admin_pas']=encrypt($data['admin_pas']);
    $add=['admin_tel'=>$data['admin_tel'],'admin_pas'=>$data['admin_pas'],'admin_auth'=>$code2,'admin_time'=>$user_time];
    $login=Login::insert($add);
    if($login){
        return redirect('/login');
    }
}
/**
 * 邮箱发送
 */
public function senEmail(){
    $email='2019768476@qq.com';
    Mail::to($email)->send(new SenCode());
}
/**
 * 短信发送
 */
public function sendsms($tel,$code){
// Download：https://github.com/aliyun/openapi-sdk-php
// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

AlibabaCloud::accessKeyClient('LTAI4FxuPPnJF3fhUi3K2tiJ', '1kcjwvhdmbaDEKRTVJiKJW6alkYHeC')
                        ->regionId('cn-hangzhou')
                        ->asDefaultClient();
try {
    $result = AlibabaCloud::rpc()
                          ->product('Dysmsapi')
                          // ->scheme('https') // https | http
                          ->version('2017-05-25')
                          ->action('SendSms')
                          ->method('POST')
                          ->host('dysmsapi.aliyuncs.com')
                          ->options([
                                        'query' => [
                                          'RegionId' => "cn-hangzhou",
                                          'PhoneNumbers' => "$tel",
                                          'SignName' => "墨墨",
                                          'TemplateCode' => "SMS_181865646",
                                          'TemplateParam' => "{code:$code}",
                                        ],
                                    ])
                          ->request();
    return $result->toArray();
    } catch (ClientException $e) {
    return $e->getErrorMessage();
    } catch (ServerException $e) {
    return $e->getErrorMessage();
    }
    }
}
