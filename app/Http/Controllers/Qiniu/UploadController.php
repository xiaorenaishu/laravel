<?php

namespace App\Http\Controllers\Qiniu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Qiniu\Auth;

class UploadController extends Controller
{
    private $accessKey = '-YwTAX_Ir89zrFkSa0M6B6Gl8OEc67_Shbuk58tW';
    private $secretKey = '48yAPtYWxQmVFOYj4TKJSskibIATUz7DNvT-Yszo';


    public function index()
    {

    }

    /**
     * Name uptoken
     * Time 2018/5/19
     */
    public function uptoken()
    {
        // 初始化签权对象
        $auth   = new Auth($this->accessKey, $this->secretKey);
        $bucket = 'chenxinren2'; //空间bucket
        // 生成上传Token
        $token = $auth->uploadToken($bucket);
        return [
            'token'  => $token,
            'domain' => 'pizjl8zaq.bkt.clouddn.com'  //测试用的临时域名，有效期1个月
        ];
        die;
    }

    ////
    public function demo()
    {
        var_dump($_GET);
    }

    public function test($id)
    {
        if($id > 10){
            return true;
        }
        return false;
    }
}
