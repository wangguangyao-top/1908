<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('userinfo2/store')}}" method="post">
    @csrf
        <table>
            <tr>
                <td>用户名称</td>
                <td><input type="text" name="user_name"></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input type="password" name="user_pwd"></td>
            </tr>
            <tr>
                <td></td>
                <td><button>登录</button></td>
            </tr>
        </table>
    </form>
</body>
</html>