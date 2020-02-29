@foreach($data4 as $k=>$v)
        <tr>
            <td>{{$v->e_id}}</td>
            <td>{{$v->e_name}}</td>
            <td>{{$v->c_name}}</td>
            <td>{{$v->significance==1?'普通':'重要'}}</td>
            <td>{{$v->show==1?'√':'×'}}</td>
            <td>{{date("Y-m-d H:i:s",$v->e_time)}}</td>
        </tr>
        @endforeach
        <tr>
            <td>{{$data4->appends(['e_name'=>$e_name,'c_id'=>$c_id])->links()}}</td>
        </tr>