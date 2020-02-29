<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('students/update').'/'.$find->s_id}}" method="post">
    @csrf
        <table>
            <tr>
                <td>学生姓名</td>
                <td><input type="text" name="s_name" value="{{$find->s_name}}"></td>
            </tr>
            <tr>
                <td>学生性别</td>
                <td>
                    <input type="radio" name="s_sex" @if($find->s_sex==1) checked @endif value="1">男
                    <input type="radio" name="s_sex" @if($find->s_sex==2) checked @endif value="2">女
                </td>
            </tr>
            <tr>
                <td>班级名称</td>
                <td>
                    <select name="s_class">
                        <option value="">--请选择--</option>
                        <option @if($find->s_sex==1) selected @endif value="1">1907php</option>
                        <option @if($find->s_sex==2) selected @endif value="2">1908php</option>
                        <option @if($find->s_sex==3) selected @endif value="3">1909php</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>成绩</td>
                <td><input type="text" name="s_chengji" value="{{$find->s_chengji}}"></td>
            </tr>
            <tr>
                <td></td>
                <td><button>修改</button></td>
            </tr>
        </table>
    </form>
</body>
</html>