<?php

namespace App\Http\Controllers;
use App\Http\Middleware\checktoken1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis; 
use App\C_class;
use App\E_essay;
class essayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page2=request()->page??'1';
       //Cache::flush();
        $e_name=request()->e_name;
        $c_id=request()->c_id;
        $where=[];
        if($e_name){
            $where[]=['e_name','like','%'.$e_name.'%'];
        }
        if($c_id){
            $where[]=['class.c_id','=',$c_id];
        }
        $data=cache('essay-'.$page2.'-'.$e_name.'-'.$c_id);
        // dump($data);
        if(!$data){
            echo '数据库';
            $page=config('app.page');
            $data=E_essay::join('class','class.c_id','=','e_essay.c_id')->where($where)->paginate($page);
            cache(['essay-'.$page2.'-'.$e_name.'-'.$c_id=>$data],3600);
        }
        $data2=C_class::get();
        return view('essay/index',['data'=>$data,'data2'=>$data2,'e_name'=>$e_name,'c_id'=>$c_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=C_class::get();
        return view('essay/create',['data'=>$data]);
    }
    //唯一
    public function sole(){
        $e_name=request()->e_name;
            $e_id=request()->e_id;
            $where=[];
            if($e_name){
                $where[]=['e_name','=',$e_name];
            }
            if($e_id){
                $where[]=['e_id','!=',$e_id];
            }
            \DB::connection()->enableQueryLog();
            $find=E_essay::where($where)->count();
            $logs = \DB::getQueryLog();
            if($find){
                return ['ses'=>'200','msg'=>'文章标题已存在','ind'=>$find];
            }else{
                return ['ses'=>'2','msg'=>'ok','ind'=>$find];
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
        $data=$request->except('_token');
        if($request->hasFile('e_file')){
            $data['e_file']=$this->uploads('e_file');   
        }
        $data['e_time']=time();
        $add=E_essay::insert($data);
        if($add){
            return redirect('wenzang/index');
        }
    }
//文件上传
    public function uploads($file){
        if(request()->file($file)->isValid()){
            $file=request()->file($file);
            $store_result = $file->store('essay');
            return $store_result;
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
        $data=C_class::get();
        $where=[
            ['e_id','=',$id],
        ];
        $essay=E_essay::where($where)->first();
        return view('essay/edit',['data'=>$data,'essay'=>$essay]);
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
        $data=$request->except('_token');
        $where=[
            ['e_id','=',$id]
        ];
        $update=E_essay::where($where)->update($data);
        if($update==1 || $update==0){
            return redirect('/wenzang/index');
        }
    }

        //修改唯一
        public function shop_sole(){
            $e_name=request()->e_name;
            $e_id=request()->e_id;
            $where=[];
            if($e_name){
                $where[]=['e_name','=',$e_name];
            }
            if($e_id){
                $where[]=['e_id','!=',$e_id];
            }
            $find=E_essay::where($where)->count();
            if($find){
                return ['ses'=>'200','msg'=>'文章标题已存在','ind'=>$find];
            }
        }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $id=request()->e_id;
        $data=E_essay::where('e_id',$id)->delete();
        if($data){
            return ['ses'=>'200','msg'=>'删除成功'];
        }else{
            return ['ses'=>'2','msg'=>'删除失败'];
        }
    }
    public function index2(){
        //  Cache::flush();
        // Redis::flushall()
        $e_name=request()->e_name;
        $c_id=request()->c_id;
        $where=[];
        if($e_name){
            $where[]=['e_name','like','%'.$e_name.'%'];
        }
        if($c_id){
            $where[]=['e_essay.c_id','=',$c_id];
        }
        $page2=request()->page;
        // $data=cache('e_essay-'.$page2.'-'.$e_name.'-'.$c_id);
        $data=Redis::get('e_essay-'.$page2.'-'.$e_name.'-'.$c_id);
        // dd($data);
        if(!$data){
            echo 'ok';
            $page=config('app.page');
            $data=E_essay::join('class','class.c_id','=','e_essay.c_id')->where($where)->paginate($page);
            $data=serialize($data);
            Redis::setex('e_essay-'.$page2.'-'.$e_name.'-'.$c_id,30,$data);
            // cache(['e_essay-'.$page2.'-'.$e_name.'-'.$c_id=>$data],300);
        }
        $data=unserialize($data);
        $data2=Redis::get('c_class');
        if(!$data2){
            echo 'on';  
            $data2=C_class::get();
            $data2=serialize($data2);
            // cache(['c_class'=>$data2],300);
            Redis::setex('c_class',30,$data2);
        }
        $data2=unserialize($data2);
          if(request()->ajax()){
            return view('essay/page2',['data4'=>$data,'data2'=>$data2,'e_name'=>$e_name,'c_id'=>$c_id]);
         }
        return view('essay/index2',['data4'=>$data,'data2'=>$data2,'e_name'=>$e_name,'c_id'=>$c_id]);
    }
}
