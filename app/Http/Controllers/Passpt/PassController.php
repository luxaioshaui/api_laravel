<?php

namespace App\Http\Controllers\Passpt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Model\UserModel;
use Illuminate\Support\Facades\Redis;

class PassController extends Controller
{
    //
    public function zhuce(){
        return view('zhuce.test');
    }
    public function ruku(){
        $data=$_POST;
        $user_token=$data['_token'];
        $user_name=$data['nick_name'];
        $user_password=$data['user_password'];
        $where=[
            'p_user'=>$user_name
        ];
        $user_model=UserModel::where($where)->get();
        if(empty($user_name)){
            $uid=substr(md5(time().mt_rand(1000,9999)),10,10);
            $user_data=[
                'user_name'=>$user_name,
                'user_password'=>$user_password,
                'user_token'=>$user_token,
                'add_time'=>time(),
                'uid'=>$uid

            ];
            $res=UserModel::insertGetId($user_data);
            $res_data=[
                'token'=>$user_token,
                'uid'=>$uid
            ];
            $res_data=[
                'srrno'=>200,
                'msg'=>'注册成功'
            ];
            return $res_data;
        }else{
            $res_data=[
                'srrno'=>40000,
                'msg'=>'用户名已存在'
            ];
        }
        $resoult=json_decode($res_data,true);
        return $resoult;

    }
    public function passPortll(){
        $data=$_POST;
        $where=[
            'user_name'=>$data['user_name']
        ];
        var_dump($data);exit;
        $model=UserModel::where($where)->first();
        if($model){
            $pwd=pssword_verify($data['user_password'],$model['user_pwd']);
            if($pwd==true){
                $token=substr(md5(time().mt_rand(1,99999)),10,10);
                $key="str:u:token:api:".$model['user_id'];
                Redis::set($key,$token);
                $response=[
                    'errno'=>0,
                    'token'=>$token
                ];
            }else{
                $response=[
                    'errno'=>4000002,
                    'msg'=>'登录失败'
                ];
            }
        }else{
            $response=[
                'srrno'=>400003,
                'msg'=>'用户名有误'
            ];
        }
        return $response;
    }

}
