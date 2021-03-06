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
    'active_second' => 'cate_index',
));
?>
    <div class="main-content">
        <?php
        //菜单栏，权限主要控制
        $this->load->view("admin/common/bread-crumbs");
        ?>
        <div class="page-content">
            <div class="page-header">
                <a class="btn btn-lg btn-success" href="/index.php/admin/post/add_post_cate">
                    <i class="ace-icon fa fa-check"></i>
                    新增文章分类
                </a>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="row">
                        <div class="col-xs-12">
                            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>文章ID</th>
                                    <th>文章分类名称</th>
                                    <th class="hidden-480">文章分类简介</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($post)){
                                    foreach($post as $value){ ?>
                                        <tr>
                                            <td>
                                                <a href="#"><?php echo $value['id']?></a>
                                            </td>
                                            <td><?php echo $value['cat_name']?></td>
                                            <td class="hidden-480"><?php echo $value['cat_intro']?></td>
                                            <td>
                                                <div class="hidden-sm hidden-xs btn-group">
                                                    <a class="btn btn-xs btn-info" href="/index.php/admin/post/add_post_cate/<?php echo $value['id'];?>">
                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                    </a>
                                                    <button class="btn btn-xs btn-danger" onclick="del(<?php echo $value['id']?>)">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                    </button>
                                                </div>

                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                <?php }else{
                                    echo '暂无文章分类';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div><!-- /.span -->
                    </div><!-- /.row -->
                    <div class="hr hr-18 dotted hr-double"></div>
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
    function del($post_id){
        if(confirm('删除之后将不可恢复！')){
            var data =  {
                id:$post_id,
                table_name:'xihua_post_cat'
            };
            ajax_submit('/index.php/admin/post/delete', data, '/index.php/admin/post/cate_list', '删除成功');
        }
    }
</script>