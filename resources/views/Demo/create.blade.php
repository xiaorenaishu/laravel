@extends('demo.layouts')

@section('content')

    @include('demo.validator')

    <div class="panel panel-default">
        <div class="panel-heading">新增学生</div>
        <div class="panel-body">
            @include('demo._form')
        </div>
    </div>
@stop