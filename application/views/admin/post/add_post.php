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
    'active' => 'post',
    'active_second' => 'add_post',
));
?>
    <div class="main-content">
        <?php
        //菜单栏，权限主要控制
        $this->load->view("admin/common/bread-crumbs");
        ?>
        <div class="page-content">
            <div class="page-header">
                <a class="btn btn-lg btn-success" href="/index.php/admin/post/index">
                    <i class="ace-icon fa fa-check"></i>
                    返回文章列表
                </a>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form">
                        <!-- #section:elements.form -->
                        <input type="hidden" value="<?php echo $post['id']; ?>" id="post_id">
                        <div class="form-group error_title">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">文章标题</label>
                            <div class="col-sm-9 error_title2">
                                <input type="text" value="<?php echo $post['post_title']; ?>" id="form-field-1" placeholder="文章标题" class="col-xs-10 col-sm-5 post_title">
                            </div>
                        </div>
                        <div class="form-group error_title">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">文章作者</label>
                            <div class="col-sm-9 error_title2">
                                <input type="text" value="<?php echo $post['post_author']; ?>" id="form-field-1" placeholder="文章作者" class="col-xs-10 col-sm-5 post_author">
                            </div>
                        </div>
                        <input id="post_pic_data" type="hidden">
                        <div class="form-group error_title">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">文章封面</label>
                            <div class="col-sm-9">
                                <?php
                                if(!empty($post['post_pic'])){ ?>
                                    <div id="post_pic">重新上传</div><a  href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$post['post_pic']; ?>" target="_blank"><img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$post['post_pic']; ?>" width="100px" height="50px"></a>
                                <?php }else{
                                    ?>
                                    <div id="post_pic">上传封面</div>
                                <?php }?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">文章简介</label>
                            <div class="col-sm-9">
                                <textarea class="form-control limited post_intro" id="form-field-9" style="margin: 0px -0.34375px 0px 0px; height: 80px; width: 516px;"><?php echo $post['post_intro']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">文章所属分类</label>
                            <div class="col-sm-3">
                                <select class="form-control post_cate" id="form-field-select-1">
                                    <?php
                                    if(!empty($post_cate)){
                                        foreach($post_cate as $value){ ?>
                                            <option value="<?php echo $value['id']?>"><?php echo $value['cat_name']?></option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">文章内容</label>
                            <div class="col-sm-9">
                                <script id="editor" type="text/plain" style="width:1024px;height:500px;"><?php echo $post['post_content']; ?></script>
                            </div>
                        </div>
                        <div class="form-group">
                            <input  id="recommend_val" type="hidden" value="<?php echo ($post['recommend'] == 1) ? 1 : 0;?>">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">是否置顶</label>
                            <div class="col-xs-3">
                                <label>
                                    <input name="switch-field-1" class="ace ace-switch ace-switch-5" type="checkbox" <?php echo ($post['recommend'] == 1) ? 'checked' : '';?>>
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
    <script type="text/javascript" charset="utf-8" src="/static/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/static/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">

        //实例化编辑器
        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
        var ue = UE.getEditor('editor');


        function isFocus(e){
            alert(UE.getEditor('editor').isFocus());
            UE.dom.domUtils.preventDefault(e)
        }
        function setblur(e){
            UE.getEditor('editor').blur();
            UE.dom.domUtils.preventDefault(e)
        }
        function insertHtml() {
            var value = prompt('插入html代码', '');
            UE.getEditor('editor').execCommand('insertHtml', value)
        }
        function createEditor() {
            enableBtn();
            UE.getEditor('editor');
        }
        function getAllHtml() {
            alert(UE.getEditor('editor').getAllHtml())
        }
        function getContent() {
            var arr = [];
            arr.push("使用editor.getContent()方法可以获得编辑器的内容");
            arr.push("内容为：");
            arr.push(UE.getEditor('editor').getContent());
            alert(arr.join("\n"));
        }
        function getPlainTxt() {
            var arr = [];
            arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
            arr.push("内容为：");
            arr.push(UE.getEditor('editor').getPlainTxt());
            alert(arr.join('\n'))
        }
        function setContent(isAppendTo) {
            var arr = [];
            arr.push("使用editor.setContent('欢迎使用ueditor')方法可以设置编辑器的内容");
            UE.getEditor('editor').setContent('欢迎使用ueditor', isAppendTo);
            alert(arr.join("\n"));
        }
        function setDisabled() {
            UE.getEditor('editor').setDisabled('fullscreen');
            disableBtn("enable");
        }

        function setEnabled() {
            UE.getEditor('editor').setEnabled();
            enableBtn();
        }

        function getText() {
            //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
            var range = UE.getEditor('editor').selection.getRange();
            range.select();
            var txt = UE.getEditor('editor').selection.getText();
            alert(txt)
        }

        function getContentTxt() {
            var arr = [];
            arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
            arr.push("编辑器的纯文本内容为：");
            arr.push(UE.getEditor('editor').getContentTxt());
            alert(arr.join("\n"));
        }
        function hasContent() {
            var arr = [];
            arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
            arr.push("判断结果为：");
            arr.push(UE.getEditor('editor').hasContents());
            alert(arr.join("\n"));
        }
        function setFocus() {
            UE.getEditor('editor').focus();
        }
        function deleteEditor() {
            disableBtn();
            UE.getEditor('editor').destroy();
        }
        function disableBtn(str) {
            var div = document.getElementById('btns');
            var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
            for (var i = 0, btn; btn = btns[i++];) {
                if (btn.id == str) {
                    UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
                } else {
                    btn.setAttribute("disabled", "true");
                }
            }
        }
        function enableBtn() {
            var div = document.getElementById('btns');
            var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
            for (var i = 0, btn; btn = btns[i++];) {
                UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
            }
        }

        function getLocalData () {
            alert(UE.getEditor('editor').execCommand( "getlocaldata" ));
        }

        function clearLocalData () {
            UE.getEditor('editor').execCommand( "clearlocaldata" );
            alert("已清空草稿箱")
        }
    </script>
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
        var post_title = $('.post_title').val();
        var post_id = $('#post_id').val();
        var post_intro = $('.post_intro').val();
        var post_cate = $('.post_cate').val();
        var post_author = $('.post_author').val();
        var recommend_val = $('#recommend_val').val();
        var post_pic_data = $('#post_pic_data').val();
        var post_content = UE.getEditor('editor').getContent();
        if(!post_title){
            alert('文章标题不能为空');
            return;
        }
        if(!post_intro){
            alert('文章简介不能为空');
            return;
        }
        if(!post_cate){
            alert('文章分类不能为空');
            return;
        }
        if(!post_content){
            alert('文章内容不能为空');
            return;
        }
        if(!post_pic_data){
            alert('文章封面不能为空');
            return;
        }
        var data =  {
            post_title:post_title,
            post_content:post_content,
            post_intro:post_intro,
            cat_id:post_cate,
            post_pic:post_pic_data,
            post_author:post_author,
            post_id:post_id,
            recommend:recommend_val
        };
        var success_msg = '添加成功';
        if(post_id > 0){
            success_msg = '更新成功';
        }
        ajax_submit('/index.php/admin/post/add_post_by_ajax', data, '/index.php/admin/post/index', success_msg);
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
