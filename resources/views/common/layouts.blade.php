<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel-DEMO</title>
    <!-- Bootstrap CSS 文件 -->
    <link rel="stylesheet" href="{{asset('/static/bootstrap/css/bootstrap.min.css')}}">
</head>
<body>

<!-- 头部 -->
<div class="jumbotron">
    <div class="container">
        @yield('title')
    </div>
</div>

<!-- 中间内容区局 -->
<div class="container">
    <div class="row">

        <!-- 左侧菜单区域   -->
        <div class="col-md-3">
            @section('left-menu')
                <div class="list-group">
                    <a href="{{url('admin/student/index')}}"
                       class="list-group-item {{ Request::getPathInfo() == '/admin/student/index' ? 'active': '' }}">学生列表</a>
                    <a href="{{route('student_create')}}"
                       class="list-group-item {{ strpos(Request::getPathInfo(), '/admin/student/create') !== false || strpos(Request::getPathInfo(), '/admin/student/update') !== false  ? 'active': ''}}">新增/编辑学生</a>
                </div>
            @show
        </div>

        <!-- 右侧内容区域 -->
        <div class="col-md-9">
            @section('content')

            @show
        </div>
    </div>
</div>

<!-- 尾部 -->
<div class="jumbotron" style="margin:0;">
    <div class="container">
        @section('foot')
            <span>  @2018</span>
        @show
    </div>
</div>

<!-- jQuery 文件 -->
<script src="{{asset('/static/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap JavaScript 文件 -->
<script src="{{asset('/static/bootstrap/js/bootstrap.min.js')}}"></script>

</body>
</html>