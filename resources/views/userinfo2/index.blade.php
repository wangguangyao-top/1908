<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border='1'>
        <tr>
            <td>用户id</td>
            <td>用户名称</td>
            <td>用户身份</td>
            <td>操作</td>
        </tr>
    @foreach($data as $k=>$v)
        <tr>
            <td>{{$v->user_id}}</td>
            <td>{{$v->user_name}}</td>
            <td>{{$v->user_admin==1?"普通":'超级'}}</td>
            <td>
                <a href="{{url('userinfo2/destroy').'/'.$v->user_id}}">删除</a>
                <a href="{{url('userinfo2/add')}}">添加</a>
            </td>
        </tr>
    @endforeach
    </table>
</body>
</html>