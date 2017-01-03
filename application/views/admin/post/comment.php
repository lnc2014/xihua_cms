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
    'active' => 'comment'
));
?>
    <div class="main-content">
        <?php
        //菜单栏，权限主要控制
        $this->load->view("admin/common/bread-crumbs");
        ?>
        <div class="page-content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="row">
                        <div class="col-xs-12">
                            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>评论ID</th>
                                    <th>评论文章标题</th>
                                    <th class="hidden-480">评论者姓名</th>
                                    <th class="hidden-480">评论者邮箱</th>
                                    <th class="hidden-480">评论内容</th>
                                    <th class="hidden-480">评论时间</th>
                                    <th class="hidden-480">评论状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($comments)){
                                    foreach($comments as $value){ ?>
                                        <tr>
                                            <td>
                                                <a href="#"><?php echo $value['id']?></a>
                                            </td>
                                            <td><?php echo $value['post_title']?></td>
                                            <td class="hidden-480"><?php echo $value['name']?></td>
                                            <td class="hidden-480"><?php echo $value['email']?></td>
                                            <td><?php echo $value['comment']?></td>
                                            <td><?php echo $value['create_time']?></td>
                                            <td><?php
                                                if($value['status'] == 0){ ?>
                                                    <td class="hidden-480">
													<span class="label label-sm label-warning">待审核</span>
                                                <?php }elseif($value['status'] == 1){ ?>
                                                    <span class="label label-sm label-success">通过审核</span>
                                                    <?php }else{?>
                                                    <span class="label label-sm label-error arrowed-in">不通过审核</span>
                                                    <?php } ?>
                                                    </td>
                                            <td>
                                                <div class="hidden-sm hidden-xs btn-group">
                                                    <button class="btn btn-xs btn-info" onclick="pass(<?php echo $value['id']; ?>, 1)" >
                                                        通过审核
                                                    </button>
                                                    <button class="btn btn-xs btn-danger" onclick="pass(<?php echo $value['id']; ?>, 2)">
                                                        不通过审核
                                                    </button>
                                                </div>

                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                <?php }else{
                                    echo '暂无评论';
                                }
                                ?>
                                </tbody>
                            </table>
                            <?php
                            //加载公共分页组件
                            $this->load->view("admin/common/page",array(
                                'all_record' => $all_record,
                                'page' => $current_page,
                                'pages' => $all_pages,
                                'url' => '/index.php/admin/post/comment'
                            ));
                            ?>
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
    function pass(id, status){
        if(confirm('审核之后将不可恢复！')){
            var data =  {
                id:id,
                status:status
            };
            ajax_submit('/index.php/admin/post/check_comment', data, '/index.php/admin/post/comment', '审核成功');
        }
    }
</script>
