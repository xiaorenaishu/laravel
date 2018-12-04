<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\Qiniu\UploadController;

class DemoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDemoTest()
    {
        $a = 1;
        $b = 1;
        self::assertTrue($a == $b, '条件不成立');
    }

    public function testDemo2Test(){
        $key = 2;
        $array = [1,2,3,4];
        self::assertContains($key, $array, '数组不包含指定元素');
    }

    public function test(){
        $a = 1;
        $b = 1;
        self::assertEquals($a, $b, '不相等');
    }

    /**
     * 测试七牛云上传token生成
     * Time 2018/5/20
     */
    public function testUploadTokenTest(){
        $uploadCls = new UploadController();
        $res = $uploadCls->uptoken();

        self::assertArrayHasKey ('token', $res, 'uptoken为空');
        self::assertArrayHasKey ('domain', $res, 'domain为空');


        $res = $uploadCls->test(11);
        self::assertTrue($res, '七牛云测试条件不成立');
    }
}
