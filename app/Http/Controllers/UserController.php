<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class UserController extends Controller
{
    function index(){
        echo '123';
    }
    function add(){
        return view('user.add');
    }
    function addd(Request $request){
        $data=$request->all();
        dd($data);
    }
    function all(){
        return view('user.ass');
    }
    function alls(Request $request){
        $data=$request->all();
        dd($data);
    }
}
 