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
        echo '入库';
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
