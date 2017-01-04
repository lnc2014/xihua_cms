<?php
/**
 * Author:LNC
 * Description: 后台首页
 * Date: 2016/12/21 0021
 * Time: 下午 6:30
 */
?>
<?php
//加载公共头部文件
$this->load->view("admin/common/header");
$this->load->view("admin/common/nav-bar");
?>
<link href="/static/admin/webuploader/css/webuploader.css" rel="stylesheet" type="text/css" />
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>
<?php
//菜单栏，权限主要控制
$this->load->view("admin/common/side-bar", array(
    'active' => 'banner',
));
?>
    <div class="main-content">
        <?php
        //菜单栏，权限主要控制
        $this->load->view("admin/common/bread-crumbs");
        ?>
        <div class="page-content">
            <div class="page-header">
                <a class="btn btn-lg btn-success" href="/index.php/admin/home/banner">
                    <i class="ace-icon fa fa-check"></i>
                    返回banner列表
                </a>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form">
                        <!-- #section:elements.form -->
                        <input type="hidden" value="<?php echo $banner['id']; ?>" id="banner_id">
                        <div class="form-group error_title">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">banner标题</label>
                            <div class="col-sm-9 error_title2">
                                <input type="text" value="<?php echo $banner['title']; ?>" id="form-field-1" placeholder="banner标题" class="col-xs-10 col-sm-5 title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">banner简介</label>
                            <div class="col-sm-9">
                                <textarea class="form-control limited banner_intro" id="form-field-9" style="margin: 0px -0.34375px 0px 0px; height: 80px; width: 516px;"><?php echo $banner['banner_intro']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group error_title">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">banner需要跳转的链接</label>
                            <div class="col-sm-9 error_title2">
                                <input type="text" value="<?php echo $banner['link_url']; ?>" id="form-field-1" placeholder="链接" class="col-xs-10 col-sm-5 link_url">
                                <small>例如：http://xihua_cms/index.php/web/post_detail/8</small>
                            </div>
                        </div>
                        <input id="post_pic_data" type="hidden">
                        <div class="form-group error_title">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">banner图片</label>
                            <div class="col-sm-9">
                               <div id="post_pic">上传banner</div><small>建议上传1140*600大小的图片，不然会出现兼容性问题</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <input  id="recommend_val" type="hidden" value="0">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">是否展示</label>
                            <div class="col-xs-3">
                                <label>
                                    <input name="switch-field-1" class="ace ace-switch ace-switch-5" type="checkbox">
                                    <span class="lbl" id="recommend"></span>
                                </label>
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="button" id="save">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    保存
                                </button>
                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    重置
                                </button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.col -->
            </div>
        </div><!-- /.page-content -->
    </div><!-- /.main-content -->
    <?php
    //加载公共底部文件
    $this->load->view("admin/common/footer-common");
    ?>
</div><!-- /.main-container -->
<?php
//加载公共底部文件
$this->load->view("admin/common/footer");
?>
<script type="text/javascript" charset="utf-8" src="/static/admin/webuploader/js/webuploader.min.js"> </script>
<script>
    $('#recommend').click(function(){
        var recommend_val = $("#recommend_val").val();
        console.log(recommend_val);
        if(recommend_val == 0){
            $("#recommend_val").val(1);
        }else{
            $("#recommend_val").val(0);
        }
    });
    $("#save").click(function(){
        var title = $('.title').val();
        var banner_id = $('#banner_id').val();
        var banner_intro = $('.banner_intro').val();
        var link_url = $('.link_url').val();
        var is_show = $('#recommend_val').val();
        var banner = $('#post_pic_data').val();
        if(!banner){
            alert('图片不能为空 ');
            return;
        }
        var data =  {
            banner_id:banner_id,
            link_url:link_url,
            banner_intro:banner_intro,
            title:title,
            banner:banner,
            is_show:is_show
        };
        var success_msg = '添加成功';
        if(banner_id > 0){
            success_msg = '更新成功';
        }
        ajax_submit('/index.php/admin/home/add_banner_by_ajax', data, '/index.php/admin/home/banner', success_msg);
    });
    var image = ['image/gif', 'image/jpg', 'image/jpeg', 'image/bmp', 'image/png'];
    upload('#post_pic', 'post_pic');
    /**
     * 上传函数
     */
    function upload(id, id_name){
        var uploader;
        // 初始化Web Uploader
        uploader = WebUploader.create({
            // 自动上传。
            auto: true,
            // swf文件路径
            swf: 'Uploader.swf',
            // 文件接收服务端。
            server: '/index.php/admin/home/upload',
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: id
            // 只允许选择文件，可选。
        });

        // 当有文件被添加进队列的时候
        uploader.on( 'fileQueued', function() {
            $(id).html('正在上传...');
        });
        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function(file, data ) {
            if(data.result == '0000'){
                alert('上传成功！');
                $('#'+id_name+'_data').val(data.data.path2);
                $('#'+id_name+'_url').addClass('none');
                var second = '<button id="second'+id_name+'" class="btn_primary">重新上传</button>';
                $(id).html(second);
                var html = '<a target="_blank" style="margin-left: 20px" href='+data.data.path+ '>点击预览</a>';
                $(id).after().append(html);
                $('#second'+id_name).click(function(){
                    $(id).html('重新上传');
                    $('#'+id_name+'_data').val('');//将已经上传成功的文件置空
                    upload(id, id_name);
                });
            }else{
                alert('上传失败');
                $(id).html('上传失败');
                var second = '<button id="second'+id_name+'" class="btn_primary">重新上传</button>';
                $(id).html(second);
                $('#second'+id_name).click(function(){
                    $(id).html('重新上传');
                    $('#'+id_name+'_data').val('');//将已经上传成功的文件置空
                    upload(id, id_name);
                });
            }
        });
        // 文件上传失败，现实上传出错。
        uploader.on( 'uploadError', function( file, data) {
            $(id).html('上传失败');
        });
        uploader.on( 'uploadProgress', function() {
            $(id).html('正在上传...');
        });

        $(id).click(function(){
            //uploader.upload(id);
        });
    }
</script>
