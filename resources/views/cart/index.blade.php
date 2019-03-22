{{-- 购物车 --}}
@extends('layouts.bst')

@section('content')
    <div class="container">
        <ul>
            @foreach($list as $k=>$v)
                <li>{{$v['goods_id']}}    --  {{$v['goods_name']}}  -  ¥ {{$v['price'] / 100}}   --  {{date('Y-m-d H:i:s',$v['add_time'])}}
                     --  个数：{{$v['num']}}
                    <a href="/cart/del2/{{$v['goods_id']}}" class="del_goods">删除</a></li>
            @endforeach
        </ul>
        <h2>订单总额：¥ {{$total / 100}}</h2>
        <hr>

        <a href="/order/add" id="submit_order" class="btn btn-info "> 提交订单 </a>
    </div>

@endsection

@section('footer')
    @parent
@endsection