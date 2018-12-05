<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<script src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script type="application/javascript" src="https://unpkg.com/qiniu-js@2.2/dist/qiniu.min.js"></script>
<div class="content">
    <br>
    <h3>七牛云直传，分片上传，断点续传</h3><span>PS：图片水印还没处理</span>
    <h5><a href="https://developer.qiniu.com/kodo/sdk/1283/javascript">javascript-SDK官方文档</a></h5>
    选择文件：<input id='file' type="file" >
    <button class="control-upload">上传</button>
</div>
<div>
    <p class="content percent"></p>
</div>
<div class="control-container content"></div>
<div class="chunkpercent content"></div>
<script>

    var flag = true;
    var subscription;
    $('.control-upload').click(function () {
        $.get('/upload/token', function (res) {
            if (res.token) {
                var file = $('#file').get(0).files[0];
                if (!file) return false;
                var finishedAttr = [];
                var compareChunks = [];
                var observable;
                var token = res.token;
                var domain = res.domain;
                var key = file.name;
                // 设置next,error,complete对应的操作，分别处理相应的进度信息，错误信息，以及完成后的操作
                var error = function (err) {
                    $(".control-upload").text("继续上传");
                    console.log(err);
                    alert("上传出错")
                };

                var complete = function (response) {
                    // console.log(response);
                    $(".control-container")
                        .html(
                            // "<p><strong>Hash：</strong>" +
                            // response.hash +
                            // "</p>" +
                            "<p><strong>已上传文件：</strong>" +
                            "<a target='_blank' href='http://" + domain + '/' + response.key + "'>查看</a>" +
                            "</p>"
                        );
                };

                var next = function (response) {
                    // console.log(response);
                    var chunks = response.chunks || [];
                    var total = response.total;
                    // 这里对每个chunk更新进度，并记录已经更新好的避免重复更新，同时对未开始更新的跳过
                    for (var i = 0; i < chunks.length; i++) {
                        if (chunks[i].percent === 0 || finishedAttr[i]) {
                            continue;
                        }
                        if (compareChunks[i].percent === chunks[i].percent) {
                            continue;
                        }
                        if (chunks[i].percent === 100) {
                            finishedAttr[i] = true;
                        }
                    }
                    $(".percent").html("进度：" + total.percent + "% ");
                    compareChunks = chunks;
                    var chunkOk = 0;
                    var chunkNoOk = 0;
                    for(var i=0; i < compareChunks.length; i++){
                        if(compareChunks[i].percent == 100){
                            ++chunkOk;
                        }else{
                            ++chunkNoOk;
                        }
                    }
                    $('.chunkpercent').html(chunkOk + '块完成上传，还差' +chunkNoOk+ '块未完成');
                };

                var subObject = {
                    next: next,
                    error: error,
                    complete: complete
                };
                var putExtra = {
                    fname: key,
                    params: {},
                    mimeType: null //这里对上传类型进行限制
                };
                var config = {
                    useCdnDomain: true,
                    disableStatisticsReport: false,
                    retryCount: 5,
                    region: null
                };
                // 调用sdk上传接口获得相应的observable，控制上传和暂停
                observable = qiniu.upload(file, key, token, putExtra, config);
                if (flag) {
                    $('.control-upload').html("暂停上传");
                    flag = false;
                    subscription = observable.subscribe(subObject);
                } else {
                    flag = true;
                    $('.control-upload').html("继续上传");
                    subscription.unsubscribe();
                }
            }
        })
    })
</script>
</body>
</html>
