    <form action="{{route('do')}}" method="post">
    @csrf
        <input type="text" name="a">
        <input type="text" name="b">
        <input type="submit" value="提交">
    </form>