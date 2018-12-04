<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use App\Models\Articel;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Qiniu\Auth;

class DemoController extends Controller
{
    //
    public function demo(Request $request)
    {
//        var_dump($request->all());
//        var_dump(\Illuminate\Support\Facades\Request::instance()->id);
//        $a = new Articel();
//        echo $a->getTable();
        $ab =  [1, 2];
//        return response()->json($ab);
        return response();
    }

    /**
     * DB fasades
     * Name dbTest
     * Time 2018/12/2
     */
    public function dbTest()
    {
        //原生 SQL 查询
        $q = DB::select('select * from user');
        var_dump($q);

//        DB::insert();
//        DB::update();
//        DB::delete();
//        var_dump($q[0]);


        //事务支持，两个方式
//        DB::transaction(function(){
//            事务语句
//        }, 2);
//        DB::beginTransaction();
//

        //查询构造器
        $q = DB::table('user')->select('id', 'real_name')->get();//->where('id', 1);//->pluck('real_name'); //->first();
        var_dump($q);


        //orm 查询，其实就是activityRecode，跟Yii一样，只是他不用写字段
    }

    public function mid2()
    {
        return view('demo.demo');
    }

    public function viewDemo()
    {
        $list = Articel::paginate(2);
        return view('demo.demo', ['students' => $list]);

    }

    public function create(Request $request)
    {
        $student = new Articel();

        if ($request->isMethod('POST')) {

            // 1. 控制器验证
            /*
            $this->validate($request, [
                'Student.name' => 'required|min:2|max:20',
                'Student.age' => 'required|integer',
                'Student.sex' => 'required|integer',
            ], [
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'integer' => ':attribute 必须为整数',
            ], [
                'Student.name' => '姓名',
                'Student.age' => '年龄',
                'Student.sex' => '性别',
            ]);
            */

            // 2. Validator类验证
            $validator = \Validator::make($request->input(), [
                'Student.name' => 'required|min:2|max:20',
                'Student.age' => 'required|integer',
                'Student.sex' => 'required|integer',
            ], [
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'integer' => ':attribute 必须为整数',
            ], [
                'Student.name' => '姓名',
                'Student.age' => '年龄',
                'Student.sex' => '性别',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }


            $data = $request->input('Student');

            if (Articel::create($data) ) {
                return redirect('demo/demo')->with('success', '添加成功!');
            } else {
                return redirect()->back();
            }
        }

        return view('demo.create', [
            'student' => $student
        ]);
    }
}
