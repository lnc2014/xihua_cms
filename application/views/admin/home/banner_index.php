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
                <a class="btn btn-lg btn-success" href="/index.php/admin/home/add_banner">
                    <i class="ace-icon fa fa-check"></i>
                    增加banner图
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
                                    <th>ID</th>
                                    <th>banner标题</th>
                                    <th class="hidden-480">banner简介</th>
                                    <th class="hidden-480">banner缩略图</th>
                                    <th class="hidden-480">banner上传时间</th>
                                    <th class="hidden-480">是否展示</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($banners)){
                                    foreach($banners as $value){ ?>
                                        <tr>
                                            <td>
                                                <a href="#"><?php echo $value['id']?></a>
                                            </td>
                                            <td><?php echo $value['title']?></td>
                                            <td class="hidden-480"><?php echo $value['banner_intro']?></td>
                                            <td class="hidden-480">
                                                <a  href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$value['banner']; ?>" target="_blank"><img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$value['banner']; ?>" width="100px" height="50px"></a>
                                            </td>
                                            <td><?php echo $value['create_time']?></td>
                                            <td><?php
                                                if($value['is_show'] == 1){
                                                    echo '展示';
                                                }else{
                                                    echo '不展示';
                                                }
                                                ?></td>
                                            <td>
                                                <div class="hidden-sm hidden-xs btn-group">
                                                    <a class="btn btn-xs btn-info" href="/index.php/admin/hoem/add_banner/<?php echo $value['id'];?>">
                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                    </a>
                                                    <button class="btn btn-xs btn-danger" onclick="del(<?php echo $value['id'] ?>)">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                    </button>
                                                </div>

                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                <?php }else{
                                    echo '暂无banner';
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
                table_name:'xihua_post'
            };
            ajax_submit('/index.php/admin/post/delete', data, '/index.php/admin/post/index', '删除成功');
        }
    }
</script>
