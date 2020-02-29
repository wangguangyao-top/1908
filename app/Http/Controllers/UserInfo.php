<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userinfo2;
class UserInfo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Userinfo2::all();
        return view('userinfo2/index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('userinfo2/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        $where=[
            ['user_name','=',$data['user_name']],
            ['user_pwd','=',$data['user_pwd']],
        ];
        $userinfo=Userinfo2::where($where)->first();
        if($userinfo){
            return redirect('userinfo2/show')->cookie('user_admin',$userinfo['user_admin'],3600);
        }else{
            echo '<script>alert("用户名或密码不正确")</script>';
            die;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $cookie=request()->cookie('user_admin');
        return view('userinfo2/show',['cookie'=>$cookie]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
       $data=Userinfo2::destroy($id);
       if($data){
            return redirect('userinfo2/index');
       }
    }
    public function add(){
        return view('userinfo2/add');
    }

    public function add2(Request $request){
        $data=$request->except('_token');
        $data['user_admin']=rand(1,2);
        $data2=Userinfo2::insert($data);
        if($data2){
            return redirect('userinfo2/index');
        }

    }
}
