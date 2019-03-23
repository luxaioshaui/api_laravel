{{-- 用户注册--}}

@extends('layouts.bst')

@section('content')
    <form class="form-signin" action="/login/weblogin" method="post">
        {{csrf_field()}}
        <h2 class="form-signin-heading">用户登录</h2>
        <label for="inputNickName">UserName</label>
        <input type="text" name="nick_name" id="inputNickName" class="form-control" placeholder="you username" required autofocus>
        <label for="inputPassword" >PassWord</label>
        <input type="password" name="u_pass" id="inputPassword" class="form-control" placeholder="***" required>
    </form>

@endsection