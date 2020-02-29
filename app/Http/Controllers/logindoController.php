<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Login;
class logindoController extends Controller
{
    function login(Request $request){
        $user=$request->except('_token');
        $user['admin_pas']=md5(md5($user['admin_pas']));
        $login=new Login();
        $logindo=$login->where($user)->first();
        if($logindo){
            session(['admin'=>$logindo]);
            $request->session()->save();
            return redirect('people/create');
        }else{
            return redirect('admin/login');
        }
        
    }
}
