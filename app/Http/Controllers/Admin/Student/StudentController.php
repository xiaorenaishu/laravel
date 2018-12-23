<?php

namespace App\Http\Controllers\Admin\Student;

use App\Jobs\SendEmail;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $count = $request->input('count') ?? 2;
        $list = Student::orderBy('id', 'desc')->paginate($count);

//        $this->sendJob();

        return view('student.index', ['students' => $list]);
    }

    public function sendJob()
    {
        $job = new SendEmail(['data' => 111]);
//        $job->delay(86400); //延时队列
        $this->dispatch($job);
    }

    public function log()
    {
        Log::info('aa', ['bb']);
        Log::warning('bb', ['bb']);
        Log::error('aa', ['bb']);
    }

    public function cache()
    {
        Cache::put('key1', 'value1', 1);
    }

    public function cacheRead()
    {
        var_dump(Cache::get('key1'));
    }

    /**
     * 文本邮件
     * Name sendMail
     * Time 2018/12/5
     */
    public function sendMail()
    {
        \Mail::raw('邮件内容', function ($message){
            $message->from('15711553255@163.com' , '15711553255@163.com');
            $message->subject('test');
            $message->to('549328302@qq.com');
        });
    }

    public function sendMailBlade()
    {
        \Mail::send('common.mail', ['data' => 'test'], function ($message){
            $message->to('549328302@qq.com');
        });
    }

    /**
     * 增改保存、
     * Name create
     * Time 2018/12/4
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $student = new Student();
        if ($request->isMethod('POST')) {
            $validate = \Illuminate\Support\Facades\Validator::make($request->input(), [
                'student.name' => 'required|min:2|max:32',
                'student.age' => 'required|integer',
                'student.sex' => 'required|integer',
            ], [
                'required' => ':attribute 必填项',
                'min' => ':attribute 太短',
                'max' => ':attribute 太长',
                'integer' => ':attribute 只能整数',
            ], [
                'student.name' => '姓名',
                'student.age' => '年龄',
                'student.sex' => '性别',
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }

            if ($id = $request->input('id')) { //编辑
                $student = Student::find($id);
                $student->name = $request->input('student.name');
                $student->age = $request->input('student.age');
                $student->sex = $request->input('student.sex');
                if ($student->save()) {
                    return redirect('/admin/student/index');
                } else {
                    return redirect()->back()->with('error', '编辑失败');
                }
            } else {
                if (Student::insert($request->input('student'))) {
                    return redirect('/admin/student/index');
                } else {
                    return redirect()->back()->with('error', '添加失败'); //返回一次性的session  key=error value='添加失败'
                }
            }

            return redirect()->route('/admin/student/index')->with('success', '添加成功');
        }

        return view('student.create', ['student' => $student]);
    }

    public function update($id)
    {
        $info = Student::find($id);
        if (empty($info)) {
            return redirect()->back()->with('error', '找不到相关信息');
        }

        return view('student.create', ['student' => $info]);
    }

    public function delete($id)
    {
        $student = Student::find($id);
        if ($student->delete()) {
            return redirect('admin/student/index')->with('success', '删除成功');
        }

        return redirect('admin/student/index')->with('error', '删除失败');
    }
}
