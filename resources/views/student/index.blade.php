@extends('common.layouts')

@section('title')
    <h2>Laravel - DEMO</h2>

    <p> lalal form </p>
@stop
@section('left-menu')
    @parent
@stop

@section('content')

    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">学生列表</div>
        @include('common.message')
        <table class="table table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>姓名</th>
                <th>年龄</th>
                <th>性别</th>
                {{--<th>添加时间</th>--}}
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr>
                    <th scope="row">{{$student->id}}</th>
                    <td>{{$student->name}}</td>
                    <td>{{$student->age}}</td>
                    <td>{{$student->getSex($student->sex)}}</td>
{{--                    <td>{{date('Y-m-d H:i:s', $student->create_time)}}</td>--}}
                    <td>
                        <a href="{{url("/admin/student/update", ['id' => $student->id])}}">修改</a>
                        <a href="{{url("/admin/student/delete", ['id' => $student->id])}}" onclick="if(confirm('是否删除') === false) return false;">删除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- 分页  -->
    <div>
        <ul class="pagination pull-right">
            {{$students->render()}}
        </ul>
    </div>
@stop

@section('foot')
    我是页脚
@stop
