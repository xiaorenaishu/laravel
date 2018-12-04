<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <title>七牛云 - JavaScript SDK</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    {{--<link href="images/favicon.ico" rel="shortcut icon">--}}
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    {{--<link rel="stylesheet" href="./style/index.css">--}}
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">七牛云存储 - JavaScript SDK</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-6">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="#">上传示例</a>
                </li>
                <li>
                    <a href="http://developer.qiniu.com/code/v6/sdk/javascript.html">SDK 文档</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="mainContainer">
    <div class="row" style="margin-top: 20px;">
        <ul class="tip col-md-12 text-mute">
            <li>
                <small>
                    JavaScript SDK 基于 h5 file api 开发，可以上传文件至七牛云存储。
                </small>
            </li>
            <li>
                <small>临时上传的空间不定时清空，请勿保存重要文件。</small>
            </li>
            <li>
                <small>H5模式大于4M文件采用分块上传。</small>
            </li>
            <li>
                <small>上传图片可查看处理效果。</small>
            </li>
            <li>
                <small>本示例限制最大上传文件100M。</small>
            </li>
        </ul>
    </div>
    <form method="post" enctype="multipart/form-data" id="form" action="upload">
        <div id="box" class="hide">
            <button class="select-button">选择文件1</button>
            <a class="file-input" id="select"></a>
        </div>
        <div id="box2">
            <button class="select-button">选择文件2</button>
            <input class="file-input" type="file" id="select2" />
        </div>
    </form>
    <div class="nav-box" style="margin-top:30px">
        <ul id="myTab" class="nav nav-tabs">
            <li role="presentation" class="active">
                <a href="#h5" name="h5" data-toggle="tab">
                    七牛h5上传
                </a>
            </li>
            <li role="presentation">
                <a href="#expand" name="expand" data-toggle="tab">plupload插件上传</a>
            </li>
            <li role="presentation">
                <a href="#directForm" name="directForm" data-toggle="tab">form表单直传</a>
            </li>
        </ul>
        <div id="process" class="tab-content">
            <div class="tab-pane fade in active" id="h5">
                <table class="table table-striped table-hover text-left" style="margin-top:30px">
                    <thead>
                    <tr>
                        <th class="col-md-4">Filename</th>
                        <th class="col-md-2">Size</th>
                        <th class="col-md-6">Detail</th>
                    </tr>
                    </thead>
                    <tbody id="fsUploadProgress">

                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="expand">
                <table class="table table-striped table-hover text-left" style="margin-top:30px">
                    <thead>
                    <tr>
                        <th class="col-md-4">Filename</th>
                        <th class="col-md-2">Size</th>
                        <th class="col-md-6">Detail</th>
                    </tr>
                    </thead>
                    <tbody id="fsUploadProgress2">

                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="directForm">
                <form id="uploadForm" class="picForm" method="post" action="" enctype="multipart/form-data" target="ifram">
                    <button style="color:#fff;background-color:#00b7ee;position:relative;top:30px;font-weight:100;height:30px;font-size:14px;width:80px;">选择文件</button>
                    <input style="width:80px;height:30px;opacity:0;cursor:pointer" type="file" name="file" id="select3" />
                    <input name="token" style="display:none">
                    <input name="key" style="display:none" />
                    <input name="url" style="display:none" />
                </form>
                <table class="table table-striped table-hover text-left" style="margin-top:30px">
                    <thead>
                    <tr>
                        <th class="col-md-4">Filename</th>
                        <th class="col-md-2">Size</th>
                        <th class="col-md-6">Detail</th>
                    </tr>
                    </thead>
                    <tbody id="fsUploadProgress3">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <div class="display">
                    <a id = "imgContainer">
                        <img data-key="">
                    </a>
                </div>
                <div class="buttonList">
                    <ul>
                        <li>
                            <div class="watermark">
                                <span>水印控制：</span>
                                <a href="#" data-watermark="NorthWest" class="btn btn-default disabled">
                                    左上角
                                </a>
                                <a href="#" data-watermark="SouthWest" class="btn btn-default">
                                    左下角
                                </a>
                                <a href="#" data-watermark="NorthEast" class="btn btn-default">
                                    右上角
                                </a>
                                <a href="#" data-watermark="SouthEast" class="btn btn-default">
                                    右下角
                                </a>
                                <a href="#" data-watermark="false" class="btn btn-default">
                                    无水印
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="imageView2">
                                <span>缩略控制：</span>
                                <a href="#" data-imageview="large" class="btn btn-default disabled">
                                    大缩略图
                                </a>
                                <a href="#" data-imageview="middle" class="btn btn-default">
                                    中缩略图
                                </a>
                                <a href="#" data-imageview="small" class="btn btn-default">
                                    小缩略图
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="imageMogr2">
                                <span>旋转控制：</span>
                                <a href="#" data-imagemogr="left" class="btn btn-default no-disable-click">
                                    逆时针
                                </a>
                                <a href="#" data-imagemogr="right" class="btn btn-default no-disable-click">
                                    顺时针
                                </a>
                                <a href="#" data-imagemogr="no-rotate" class="btn btn-default">
                                    无旋转
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal -->
</div>
</body>
<style>
</style>
<script>
</script>
<!--[if lte IE 8]>
<script src="http://cdn.bootcss.com/jquery/1.9.0/jquery.min.js"></script>
<![endif]-->
<!--[if gt IE 8]>
<script src="http://cdn.static.runoob.com/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->
<!--[if !IE]><!-->
<script src="http://cdn.static.runoob.com/libs/jquery/1.10.2/jquery.min.js"></script>
<!--<![endif]-->
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="https://cdn.bootcss.com/json3/3.3.2/json3.min.js"></script>
<script type="text/javascript" src="https://cdn.bootcss.com/babel-polyfill/7.0.0-beta.42/polyfill.min.js"></script>
<script type="application/javascript" src="https://unpkg.com/qiniu-js@2.2/dist/qiniu.min.js"></script>
{{--<script type="text/javascript" src='http://local.laravel/com/js/uploadWithSDK.js' ></script>--}}
<!--
{{--<script type="text/javascript" src='./js/plupload.full.min.js'></script>--}}
{{--<script type="text/javascript" src='/dist/qiniu.min.js'></script>--}}
{{--<script type="text/javascript" src='./component/widget.js'></script>--}}
{{--<script type="text/javascript" src='./component/ui.js'></script>--}}
{{--<script type="text/javascript" src='./scripts/uploadWithOthers.js'></script>--}}
{{--<script type="text/javascript" src='./scripts/uploadWithForm.js'></script>--}}
{{--<script type="text/javascript" src='./scripts/uploadWithSDK.js'></script>--}}
{{--<script type="text/javascript" src='./main.js'></script>--}}
-->

<script>

    var BLOCK_SIZE = 4 * 1024 * 1024;

    function addUploadBoard(file, config, key, type) {
        var count = Math.ceil(file.size / BLOCK_SIZE);
        // var board = widget.add("tr", {
        //     data: { num: count, name: key, size: file.size },
        //     node: $("#fsUploadProgress" + type)
        // });
        // if (file.size > 100 * 1024 * 1024) {
        //     $(board).html("本实例最大上传文件100M");
        //     return "";
        // }
        // count > 1 && type != "3"
        //     ? ""
        //     : $(board)
        //         .find(".resume")
        //         .addClass("hide");
        // return board;
    }

    function createXHR() {
        var xmlhttp = {};
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        return xmlhttp;
    }

    function getBoardWidth(board) {
        var total_width = $(board)
            .find("#totalBar")
            .outerWidth();
        $(board)
            .find(".fragment-group")
            .removeClass("hide");
        var child_width = $(board)
            .find(".fragment-group li")
            .children("#childBar")
            .outerWidth();
        $(board)
            .find(".fragment-group")
            .addClass("hide");
        return { totalWidth: total_width, childWidth: child_width };
    }

    function controlTabDisplay(type) {
        switch (type) {
            case "sdk":
                document.getElementById("box2").className = "";
                document.getElementById("box").className = "hide";
                break;
            case "others":
                document.getElementById("box2").className = "hide";
                document.getElementById("box").className = "";
                break;
            case "form":
                document.getElementById("box").className = "hide";
                document.getElementById("box2").className = "hide";
                break;
        }
    }

    var getRotate = function(url) {
        if (!url) {
            return 0;
        }
        var arr = url.split("/");
        for (var i = 0, len = arr.length; i < len; i++) {
            if (arr[i] === "rotate") {
                return parseInt(arr[i + 1], 10);
            }
        }
        return 0;
    };

    function imageControl(domain) {
        $(".modal-body")
            .find(".buttonList a")
            .on("click", function() {
                var img = document.getElementById("imgContainer").getElementsByTagName("img")[0]
                var oldUrl = img.src;
                var key = img.key;
                var originHeight = img.h;
                var fopArr = [];
                var rotate = getRotate(oldUrl);
                if (!$(this).hasClass("no-disable-click")) {
                    $(this)
                        .addClass("disabled")
                        .siblings()
                        .removeClass("disabled");
                    if ($(this).data("imagemogr") !== "no-rotate") {
                        fopArr.push({
                            fop: "imageMogr2",
                            "auto-orient": true,
                            strip: true,
                            rotate: rotate
                        });
                    }
                } else {
                    $(this)
                        .siblings()
                        .removeClass("disabled");
                    var imageMogr = $(this).data("imagemogr");
                    if (imageMogr === "left") {
                        rotate = rotate - 90 < 0 ? rotate + 270 : rotate - 90;
                    } else if (imageMogr === "right") {
                        rotate = rotate + 90 > 360 ? rotate - 270 : rotate + 90;
                    }
                    fopArr.push({
                        fop: "imageMogr2",
                        "auto-orient": true,
                        strip: true,
                        rotate: rotate
                    });
                }
                $(".modal-body")
                    .find("a.disabled")
                    .each(function() {
                        var watermark = $(this).data("watermark");
                        var imageView = $(this).data("imageview");
                        var imageMogr = $(this).data("imagemogr");

                        if (watermark) {
                            fopArr.push({
                                fop: "watermark",
                                mode: 1,
                                image: "http://www.b1.qiniudn.com/images/logo-2.png",
                                dissolve: 100,
                                gravity: watermark,
                                dx: 100,
                                dy: 100
                            });
                        }
                        if (imageView) {
                            var height;
                            switch (imageView) {
                                case "large":
                                    height = originHeight;
                                    break;
                                case "middle":
                                    height = originHeight * 0.5;
                                    break;
                                case "small":
                                    height = originHeight * 0.1;
                                    break;
                                default:
                                    height = originHeight;
                                    break;
                            }
                            fopArr.push({
                                fop: "imageView2",
                                mode: 3,
                                h: parseInt(height, 10),
                                q: 100
                            });
                        }

                        if (imageMogr === "no-rotate") {
                            fopArr.push({
                                fop: "imageMogr2",
                                "auto-orient": true,
                                strip: true,
                                rotate: 0
                            });
                        }
                    });
                var newUrl = qiniu.pipeline(fopArr, key, domain);

                var newImg = new Image();
                img.src = "images/loading.gif"
                newImg.onload = function() {
                    img.src = newUrl
                    document.getElementById("imgContainer").href = newUrl
                };
                newImg.src = newUrl;
                return false;
            });
    }

    function imageDeal(board, key, domain) {
        var fopArr = [];
        //var img = $(".modal-body").find(".display img");
        var img = document.getElementById("imgContainer").getElementsByTagName("img")[0];
        img.key = key
        fopArr.push({
            fop: "watermark",
            mode: 1,
            image: "http://www.b1.qiniudn.com/images/logo-2.png",
            dissolve: 100,
            gravity: "NorthWest",
            ws: 0.8,
            dx: 100,
            dy: 100
        });
        fopArr.push({
            fop: "imageView2",
            mode: 2,
            h: 450,
            q: 100
        });
        var newUrl = qiniu.pipeline(fopArr, key, domain);
        $(board)
            .find(".wraper a")
            .html(
                '<img src=' +
                domain +
                ""/"/" +
                key +
                '>' +
                '<a data-toggle="modal" data-target="#myModal">查看处理效果</a>'
            );
        var newImg = new Image();
        img.src = "images/loading.gif"
        newImg.onload = function() {
            img.src = newUrl
            img.h = 450
            document.getElementById("imgContainer").href = newUrl
        };
        newImg.src = newUrl;
    }


    $.ajax({url: "/upload/token", success: function(res){
            var token = res.uptoken;
            var domain = res.domain;
            var config = {
                useCdnDomain: true,
                disableStatisticsReport: false,
                retryCount: 5,
                region: qiniu.region.z0
            };
            var putExtra = {
                fname: "",
                params: {},
                mimeType: null
            };
            // $(".nav-box")
            //     .find("a")
            //     .each(function(index) {
            //         $(this).on("click", function(e) {
            //             switch (e.target.name) {
            //                 case "h5":
            //                     uploadWithSDK(token, putExtra, config, domain);
            //                     break;
            //                 case "expand":
            //                     uploadWithOthers(token, putExtra, config, domain);
            //                     break;
            //                 case "directForm":
            //                     uploadWithForm(token, putExtra, config);
            //                     break;
            //                 default:
            //                     "";
            //             }
            //         });
            //     });
            imageControl(domain);
            uploadWithSDK(token, putExtra, config, domain);
        }})
    function uploadWithSDK(token, putExtra, config, domain) {
        // 切换tab后进行一些css操作
        controlTabDisplay("sdk");
        $("#select2").unbind("change").bind("change",function(){
            var file = this.files[0];
            // eslint-disable-next-line
            var finishedAttr = [];
            // eslint-disable-next-line
            var compareChunks = [];
            var observable;
            if (file) {
                var key = file.name;
                // 添加上传dom面板
                var board = addUploadBoard(file, config, key, "");
                if (!board) {
                    return;
                }
                putExtra.params["x:name"] = key.split(".")[0];
                board.start = true;
                var dom_total = $(board)
                    .find("#totalBar")
                    .children("#totalBarColor");

                // 设置next,error,complete对应的操作，分别处理相应的进度信息，错误信息，以及完成后的操作
                var error = function(err) {
                    board.start = true;
                    $(board).find(".control-upload").text("继续上传");
                    console.log(err);
                    alert("上传出错")
                };

                var complete = function(res) {
                    $(board)
                        .find("#totalBar")
                        .addClass("hide");
                    $(board)
                        .find(".control-container")
                        .html(
                            "<p><strong>Hash：</strong>" +
                            res.hash +
                            "</p>" +
                            "<p><strong>Bucket：</strong>" +
                            res.bucket +
                            "</p>"
                        );
                        console.log(res);
                    if (res.key && res.key.match(/\.(jpg|jpeg|png|gif)$/)) {
                        imageDeal(board, res.key, domain);
                    }
                };

                var next = function(response) {
                    var chunks = response.chunks||[];
                    var total = response.total;
                    // 这里对每个chunk更新进度，并记录已经更新好的避免重复更新，同时对未开始更新的跳过
                    for (var i = 0; i < chunks.length; i++) {
                        if (chunks[i].percent === 0 || finishedAttr[i]){
                            continue;
                        }
                        if (compareChunks[i].percent === chunks[i].percent){
                            continue;
                        }
                        if (chunks[i].percent === 100){
                            finishedAttr[i] = true;
                        }
                        $(board)
                            .find(".fragment-group li")
                            .eq(i)
                            .find("#childBarColor")
                            .css(
                                "width",
                                chunks[i].percent + "%"
                            );
                    }
                    $(board)
                        .find(".speed")
                        .text("进度：" + total.percent + "% ");
                    dom_total.css(
                        "width",
                        total.percent + "%"
                    );
                    compareChunks = chunks;
                };

                var subObject = {
                    next: next,
                    error: error,
                    complete: complete
                };
                var subscription;
                // 调用sdk上传接口获得相应的observable，控制上传和暂停
                observable = qiniu.upload(file, key, token, putExtra, config);

                $(board)
                    .find(".control-upload")
                    .on("click", function() {
                        if(board.start){
                            $(this).text("暂停上传");
                            board.start = false;
                            subscription = observable.subscribe(subObject);
                        }else{
                            board.start = true;
                            $(this).text("继续上传");
                            subscription.unsubscribe();
                        }
                    });
            }
        })
    }

</script>
</html>
