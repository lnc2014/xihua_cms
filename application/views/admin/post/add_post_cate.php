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
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>
<?php
//菜单栏，权限主要控制
$this->load->view("admin/common/side-bar", array(
    'active' => 'post',
    'active_second' => 'add_cate',
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
                    返回文章分类列表
                </a>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form">
                        <!-- #section:elements.form -->
                        <input type="hidden" value="<?php echo $post['id']; ?>" id="post_id">
                        <div class="form-group error_title">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">文章分类名称</label>
                            <div class="col-sm-9 error_title2">
                                <input type="text" value="<?php echo $post['cat_name']; ?>" id="form-field-1" placeholder="文章分类名称" class="col-xs-10 col-sm-5 cat_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">文章分类简介</label>
                            <div class="col-sm-9">
                                <textarea class="form-control limited cat_intro" id="form-field-9" style="margin: 0px -0.34375px 0px 0px; height: 80px; width: 516px;"><?php echo $post['cat_intro']; ?></textarea>
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
<script>
    $("#save").click(function(){
        var cat_name = $('.cat_name').val();
        var cate_id = $('#post_id').val();
        var cat_intro = $('.cat_intro').val();
        if(!cat_name){
            alert('文章分类名称不能为空');
            return;
        }
        var data =  {
            cat_name:cat_name,
            cat_intro:cat_intro,
            cate_id:cate_id
        };
        var success_msg = '添加成功';
        if(cate_id > 0){
            success_msg = '更新成功';
        }
        ajax_submit('/index.php/admin/post/add_post_cate_by_ajax', data, '/index.php/admin/post/cate_list', success_msg);
    });

</script>
