<form action="{{url('/alls')}}" method="post">
    @csrf
       商品名称： <input type="text" name="a">
       商品价钱： <input type="text" name="b">
        <input type="submit" value="提交">
</form>