<?php
/**
 * Author:LNC
 * Description: 文件上传DEMO
 * Date: 2016/9/30 0030
 * Time: 下午 2:22
 */
?>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/syntax.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/webuploader.css">
<!--引入JS-->
<script type="text/javascript" src="js/jquery-2.1.1.js"></script>
<script type="text/javascript" src="js/webuploader.js"></script>
<script type="text/javascript" src="js/bootstrap-progressbar.min.js"></script>


<div id="uploader" class="wu-example">
    <div id="thelist" class="uploader-list"></div>
    <div class="btns">
        <div id="picker" class="webuploader-container">
            <div class="webuploader-pick">选择文件</div>
        </div>
        <button id="ctlBtn" class="btn btn-default">开始上传</button>
        <a id="img_url" target="_blank"><img id="img" src="" style="width: 50px;height: 50px;display: none" ></a>
    </div>
    <div id="process">
    </div>
</div>
<script>
    var image = ['image/gif', 'image/jpg', 'image/jpeg', 'image/bmp', 'image/png'];
    jQuery(function() {
        upload();
    });
    /**
     * 上传函数
     */
    function upload(){
        var $ = jQuery,uploader;
        // 初始化Web Uploader
        uploader = WebUploader.create({
            // 自动上传。
            auto: false,
            // swf文件路径
            swf: 'Uploader.swf',
            // 文件接收服务端。
            server: 'upload.php',
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#picker'
            // 只允许选择文件，可选。
        });

        // 当有文件被添加进队列的时候
        uploader.on( 'fileQueued', function( file ) {
            console.log(file);
            var html = ' <div class="webuploader-pick">你选择的文件是：'+file.name+',大小：'+bytesToSize(file.size)+'</div>';
            $('#picker').html(html);
        });
        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file, data ) {
            if(data.code == 1){
                if($.inArray(file.type, image) > 0){
                    console.log(file);
                    $("#img").css('display','block');
                    $('#img').attr('src', data.data.path);
                    $('#img_url').attr('href', data.data.path);
                }
                $('#process').html('上传成功');
                $('#ctlBtn').addClass('cancle');
                var html = ' <div class="webuploader-pick">你已经成功上传'+file.name+'文件</div>';
                $('#picker').html(html);
                $('.cancle').html('重新上传');
                $('.cancle').on('click', function(){
                    $("#img").css('display','none');
                    var upload_html = '<div class="webuploader-pick">选择文件</div>';
                    $('#picker').html(upload_html);
                    $('#ctlBtn').removeClass('cancle');
                    $('#ctlBtn').html('开始上传');
                    $('#process').html('');
                    upload();
                });
            }else{
                $('#process').html('');
            }
        });
        // 文件上传失败，现实上传出错。
        uploader.on( 'uploadError', function( file, data) {

        });
        uploader.on( 'uploadProgress', function() {
            var process_html = '<br><div class="progress progress-striped active right"> <div class="progress-bar progress-bar-success six-sec-ease-in-out" role="progressbar" data-transitiongoal="100"></div></div>';
            $('#process').html(process_html);
            $('.progress .progress-bar').progressbar();
        });

        $('#ctlBtn').click(function(){
            uploader.upload();
        });
    }
    /**
     * 字节替换函数
     * @param bytes
     * @returns {*}
     */
    function bytesToSize(bytes) {
        if (bytes === 0) return '0 B';
        var k = 1024;
        sizes = ['B','KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        i = Math.floor(Math.log(bytes) / Math.log(k));
        return (bytes / Math.pow(k, i)).toPrecision(2) + ' ' + sizes[i];
        //toPrecision(2) 后面保留两位位小数，如1.0GB
        // return (bytes / Math.pow(k, i)).toPrecision(3) + ' ' + sizes[i];
    }

</script>