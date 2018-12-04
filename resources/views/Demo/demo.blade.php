@extends('demo.layouts')


@section('leftmenu')
    <div class="list-group">
        <a href="{{ url('student/index') }}" class="list-group-item
                    {{ Request::getPathInfo() != '/demo/create' ? 'active' : '' }}
                ">学生列表</a>
        <a href="{{ url('student/create') }}" class="list-group-item
                    {{ Request::getPathInfo() == '/demo/create' ? 'active' : '' }}
                ">新增学生</a>
    </div>
@stop

@section('content')

    @include('demo.message')

    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">学生列表</div>
        <table class="table table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>姓名</th>
                <th>年龄</th>
                <th>性别</th>
                <th>添加时间</th>
                <th width="120">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr>
                    <th scope="row">{{ $student->id }}</th>
                    <td>{{ $student->real_name }}</td>
                    <td>
                        <a href="{{ url('student/detail', ['id' => $student->id]) }}">详情</a>
                        <a href="{{ url('student/update', ['id' => $student->id]) }}">修改</a>
                        <a href="{{ url('student/delete', ['id' => $student->id]) }}"
                           onclick="if (confirm('确定要删除吗？') == false) return false;">删除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- 分页  -->
    <div>
        <div class="pull-right">
            {{ $students->render() }}
        </div>

    </div>
@stop