<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User_user;
class login extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=User_user::paginate(1);
        return view('login/index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('login/create');
    }

//唯一
    public function sole(){
        $user_name=request()->user_name;
        $user=User_user::where('user_name',$user_name)->count();
        if($user){
            return ['ses'=>200,'msg'=>'用户已存在','date'=>$user];
        }else{
            return ['ses'=>2,'msg'=>'ok','date'=>$user];
        }

    }

    public function user_sole($id){
        $user_name=request()->user_name;
        $where=[
            ['user_name','=',$user_name],
            ['user_id','!=',$id]
        ];
        $user=User_user::where($where)->count();
        if($user){
            return ['ses'=>200,'msg'=>'用户已存在','date'=>$user];
        }else{
            return ['ses'=>2,'msg'=>'ok','date'=>$user];
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data=$request->except('_token');
        $data['user_pwd']=encrypt($data['user_pwd']);
        if($request->hasFile('user_img')){
            $data['user_img']=uploads('user_img');
        }
        $data2=User_user::insert($data);
        if($data2){
            return redirect('login/index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=User_user::where('user_id',$id)->first();
        $data['user_pwd']=decrypt($data['user_pwd']);
        return view('login/edit',['data'=>$data]);
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
        $data=$request->except('_token');
        $data['user_pwd']=encrypt($data['user_pwd']);
        if($request->hasFile('user_img')){
            $data['user_img']=uploads('user_img');
        }
        $data2=User_user::where('user_id',$id)->update($data);
        if($data2==1 || $data2==0){
            return redirect('login/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=User_user::destroy($id);
        if($data){
            return redirect('login/index');            
        }
    }
}
