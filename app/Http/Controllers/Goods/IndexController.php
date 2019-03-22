<?php

namespace App\Http\Controllers\Goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\GoodsModel;

class IndexController extends Controller
{
    //


    /**
     * 商品详情
     * @param $goods_id
     */
    public function index($goods_id)
    {
        $goods = GoodsModel::where(['goods_id'=>$goods_id])->first();

        //商品不存在
        if(!$goods){
            header('Refresh:2;url=/');
            echo '商品不存在,正在跳转至首页';
            exit;
        }

        $data = [
            'goods' => $goods
        ];
        return view('goods.index',$data);
    }

    /**
     * 商品列表
     */
    public function goodsList()
    {
        $list = GoodsModel::paginate(5);            //分页
//echo '<pre>';print_r($list);echo '</pre>';die;
        $data = [
            'list'  => $list
        ];

        //echo '<pre>';print_r($list);echo '</pre>';die;
        return view('goods.list',$data);
    }

    public function uploadIndex()
    {
        return view('goods.upload');
    }

    public function uploadPDF(Request $request)
    {
        $pdf = $request->file('pdf');
        $ext  = $pdf->extension();
        if($ext != 'pdf'){
            die("请上传PDF格式");
        }
        $res = $pdf->storeAs(date('Ymd'),str_random(5) . '.pdf');
        if($res){
            echo '上传成功';
        }

    }
}
