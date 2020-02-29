<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use DB;
use App\People;
use Validator;
use Illuminate\Validation\Rule;
class peopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$data=DB::table('people')->get();
        //orm
        // $data=People::all();
        $username=request()->username??'';
        $is_hubei=request()->is_hubei??'';
        $where=[];
        if($username){
            $where[]=['username','like','%'.$username.'%'];
        }
        if($is_hubei){
            $where[]=['is_hubei','=',$is_hubei];
        }
        $page=config('app.page');
        $data=People::where($where)->paginate($page);
        return view('people.index',['data'=>$data],['username'=>$username,'is_hubei'=>$is_hubei]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('people.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //判断文件上传是否有值
  

        $data=$request->except('_token'); //去除_token字段 except


        $validator = Validator::make($data,
        [
            'username'=>['regex:/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_-]{2,12}$/u','unique:people'],
            'age'=>'required|integer|max:150',
            'is_hubei'=>'required|integer'
        ],[
            'username.regex'=>'名称由中文,字母，数字，下划线，长度2-12位组成',
            'username.unique'=>'名称已存在',
            'age.required'=>'年龄必填',
            'age.integer'=>'年龄必须是数字',
            'age.max'=>'年龄最大为150岁',
            'is_hubei.required'=>'是否是湖北人必填',
            'is_hubei.integer'=>'必须是数字'
        ]);
if($validator->fails()){
    return redirect('people/create')
           ->withErrors($validator)
           ->withInput();
};
       if($request->hasFile('head')){
           $data['head']=$this->uploads('head');
       }
        $data['add_time']=time();
        // $add=DB::table('people')->insert($data);
        //orm
        // $people=new People();
        // $people->username=$data['username'];
        // $people->age=$data['age'];
        // $people->card=$data['card'];
        // $people->is_hubei=$data['is_hubei'];
        // $people->head=$data['head'];
        // $people->add_time=$data['add_time'];
        // $add=$people->save();
        //黑名单
        $add=People::create($data);
        // $add=People::insert($data);
        if($add){
            return redirect('people/index');
        }
    }

    /**
     * Display the specified resource.
     *预览详情页
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    //文件上传
    public function uploads($file){
        //判断$file上传是否有误
        if(request()->file($file)->isValid()){
        //获取图片的信息
            $photo = request()->file($file);
        //图片的路径
            $store_result =$photo->store('uploads');
            return $store_result;
        }
      
    }
    /**
     * Show the form for editing the specified resource.
     *修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $update=DB::table('people')->where('p_id',$id)->first();
        //orm
            // $update=People::find($id);
             $update=People::where('p_id',$id)->first();
        return view('people/edit',['update'=>$update]);
    }

    /**
     * Update the specified resource in storage.
     *执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->except('_token');
        $validator = Validator::make($data,
        [
            'username'=>[
            'regex:/^[\x{4e00}-\x{9fa5}a-zA-Z0-9_-]{2,12}$/u',
            Rule::unique('people')->ignore($id,'p_id'),
        ],
            'age'=>'required|integer|max:150',
            'is_hubei'=>'required|integer'
        ],[
            'username.regex'=>'名称由中文,字母，数字，下划线，长度2-12位组成',
            'username.unique'=>'名称已存在',
            'age.required'=>'年龄必填',
            'age.integer'=>'年龄必须是数字',
            'age.max'=>'年龄最大为150岁',
            'is_hubei.required'=>'是否是湖北人必填',
            'is_hubei.integer'=>'必须是数字'
        ]);

    if($validator->fails()){
        return redirect('people/edit7/'.$id)
           ->withErrors($validator)
           ->withInput();
    };

        if($request->hasFile('head')){
            $data['head']=$this->uploads('head');
        }
        //  $update1=DB::table('people')->where('p_id',$id)->update($data);
        //orm
        // $people=People::find($id);
        // $people->username=$data['username'];
        // $people->age=$data['age'];
        // $people->card=$data['card'];
        // $people->is_hubei=$data['is_hubei'];
        // $people->head=$data['head']??'';
        // $update1=$people->save();
        $update1=People::where('p_id',$id)->update($data);
        if($update1!==false){
            return redirect('people/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *执行删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    //    $delete=DB::table('people')->where('p_id',$id)->delete();
        //   $delete=People::where('p_id',$id)->delete();
            $delete=People::destroy($id);
       if($delete){
            return redirect('people/index');
       }
    }
}
