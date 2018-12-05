@extends('common.layouts')


@section('title')
    <h2></h2>

    <p> @if(empty($student->id))新增 @else 编辑 @endif </p>
@stop

@section('content')
    <!-- 所有的错误提示 -->
    @include('common.validator')

    <!-- 自定义内容区域 -->
    <div class="panel panel-default">
        <div class="panel-heading">@if(empty($student->id)) 新增 @else 编辑 @endif 学生</div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="/admin/student/create">

                {{ csrf_field() }}

                <input type="hidden" name="id" value="{{$student->id}}">

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">姓名</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="name" name="student[name]"
                               value="{{ old('student')['name'] ?? $student->name }}" placeholder="请输入学生姓名">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('student.name')}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">年龄</label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="age" name="student[age]"
                               value="{{ old('student')['age'] ?? $student->age }}" placeholder="请输入学生年龄">
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('student.age')}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">性别</label>

                    <div class="col-sm-5">
                        @foreach($student->getSex() as $sex => $name)
                            <label class="radio-inline">
                                <input type="radio" name="student[sex]"
                                       value="{{$sex}}"
                                        @if(old('student')['sex'] == $sex || (isset($student->sex) && $student->sex == $sex))
                                            checked
                                        @endif
                                > {{$name}}
                            </label>
                        @endforeach
                    </div>
                    <div class="col-sm-5">
                        <p class="form-control-static text-danger">{{$errors->first('student.sex')}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
