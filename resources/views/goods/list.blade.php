@extends('layouts.bst')

@section('content')
    <div class="container">
        <ul>
            @foreach($list as $k=>$v)
                <li> 商品ID：{{$v->goods_id}}  --  商品价格：¥ {{$v->price}}
                    <a href="/goods/detail/{{$v->goods_id}}" >{{$v->goods_name}}</a><br><br>
                </li>
            @endforeach
        </ul>
    </div>
    {{$list->links()}}
@endsection


@section('footer')
    @parent
    <script src="{{URL::asset('/js/goods/goods.js')}}"></script>
@endsection