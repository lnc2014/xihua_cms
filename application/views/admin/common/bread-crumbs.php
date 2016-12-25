<?php
/**
 * Author:LNC
 * Description: 面包学
 * Date: 2016/12/25 0025
 * Time: 下午 2:30
 */
?>
<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
    </script>
    <!--            面包屑-->
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="/index.php/admin/home/">主页</a>
        </li>
        <li class="active"><?php echo empty($breadcrumb)?'':$breadcrumb; ?></li>
    </ul><!-- /.breadcrumb -->
</div>
