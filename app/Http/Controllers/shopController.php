<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB;
use App\People;
use Validator;
use App\Http\Requests\StorePeople;
use Illuminate\Validation\Rule;
class shopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $find=People::get();
        $username=request()->username??'';
        $where=[];
        if($username){
            $where[]=['username','like','%'.$username.'%'];
    
        }
        $page=config('app.page');
        $find=People::where($where)->orderby('p_id','desc')->paginate($page);
        return view('shop.index',['find'=>$find,'username'=>$username]);
    }

    /**
     * Show the form for creating a new resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shop.create');
    }

    /**
     * Store a newly created resource in storage.
     *添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    // public function store(StorePeople $request)
    {
        // $validatedData = $request->validate(
        //     [   
        //         'username' => 'required|unique:people|max:12|min:2',
        //         'age' => 'required|integer|max:200|min:1',
        // ],[
        //     'username.required'=>'名称必填',
        //     'username.unique'=>'名称已存在',
        //     'username.max'=>'名称最大长度12',
        //     'username.min'=>'名称最小长度2',
        //     'age.required'=>'年龄必填',
        //     'age.integer'=>'年龄必须是数字',
        //     'age.max'=>'年龄最大长度3',
        //     'age.min'=>'年龄最小长度1'
        // ]);
       $data=$request->except('_token'); 
       $validator = Validator::make($data,
        [
            'username' => 'required|unique:people|max:12|min:2',
            'age' => 'required|integer|max:200|min:1',
        ],[
            'username.required'=>'名称必填',
            'username.unique'=>'名称已存在',
            'username.max'=>'名称最大长度12',
            'username.min'=>'名称最小长度2',
            'age.required'=>'年龄必填',
            'age.integer'=>'年龄必须是数字',
            'age.max'=>'年龄最大长度3',
            'age.min'=>'年龄最小长度1'
        ]);
        if ($validator->fails()){
            return redirect('shop/create')
                   ->withErrors($validator)
                   ->withInput();
        }
       if($request->hasFile('head')){
           $data['head']=$this->uploads('head');
       }
       $data['add_time']=time();
    //    $add=DB::table('people')->insert($data);
    //    $people=new People();
    //    $people->username=$data['username'];
    //    $people->age=$data['age'];
    //    $people->card=$data['card'];
    //    $people->is_hubei=$data['is_hubei'];
    //    $people->head=$data['head']??'';
    //    $people->add_time=$data['add_time'];
    //    $add=$people->save();
       $add=People::create($data);
    // $add=People::insert($data);
       if($add){
            return redirect('shop/index');
       }  
    }

    public function uploads($file){
        //判断文件上传时是否有误
         if(request()->file($file)->isValid()){
        //获取图片的信息
            $file2=request()->file($file);
        //把图片放在uploads目录下;
            $file3=$file2->store('uploads');
            return $file3;
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
        //
        // $data=DB::table('people')->where('p_id',$id)->first();
        // $data=People::find($id);
         $data=People::where('p_id',$id)->first();
        return view('shop/edit',['data'=>$data]);
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
        $people5=People::find($id);
            $validator = Validator::make($data,
        [
            'username'=>[
                'regex:/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_-]{2,12}$/u',
                Rule::unique('people')->ignore($id,'p_id')
                ],
            'age'=>'required|integer|between:1,200',
        ],[
            'username.required'=>'名称必填',
            'username.regex'=>'名称由中文字母数字下划线长度2-12位',
            'username.unique'=>'名称已存在',
            'username.max'=>'名称最大长度12',
            'username.min'=>'名称最小长度2',
            'age.required'=>'年龄必填',
            'age.integer'=>'年龄必须是数字',
            'age.between'=>'年龄最大长度3'
        ]);
        if ($validator->fails()){
            return redirect('shop/edit/'.$id)
                   ->withErrors($validator)
                   ->withInput();
        }
        //判断图片是否有值
        if($request->hasFile('head')){
            $data['head']=$this->uploads('head');
        }
        // $update=DB::table('people')->where('p_id',$id)->update($data);
            // $people=People::find($id);
            // $people->username=$data['username'];
            // $people->age=$data['age'];
            // $people->card=$data['card'];
            // $people->is_hubei=$data['is_hubei'];
            // $people->head=$data['head']??'';
            // $update=$people->save();
        $update=People::where('p_id',$id)->update($data);            
        if($update!==false){
            return redirect('shop/index');
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
        //
        // $delete=DB::table('people')->where('p_id',$id)->delete();
        $delete=People::destroy($id);
        //  $delete=People::where('p_id',$id)->delete();        
        if($delete){
            return redirect('/shop/index');
        }

    }
}
