<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td>库存管理</td>
        </tr>
        <tr>
        @if($cookie=='1')
            <td><a href="{{url('#')}}">货物管理</a></td>
            <td><a href="#">出入库管理</a></td>
        @endif
        @if($cookie=='2')
                <td><a href="{{url('#')}}">货物管理</a></td>
                <td><a href="#">出入库管理</a></td>
                <td><a href="{{url('userinfo2/index')}}">用户管理</a></td>
        @endif
        </tr>
    </table>
</body>
</html>