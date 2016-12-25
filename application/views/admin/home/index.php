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
$this->load->view("admin/common/side-bar");
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
                    <div class="alert alert-block alert-success">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                        </button>
                        <i class="ace-icon fa fa-check green"></i>
                        当前时间为：
                        <strong class="green" id="timetable">
                        </strong>
                    </div>

                    <div class="hr hr32 hr-dotted"></div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div><!-- /.main-content -->
    <?php
    //加载公共底部文件
    $this->load->view("admin/common/footer-common");
    ?>
</div><!-- /.main-container -->

    <script>
        function get_time()
        {
            var date=new Date();
            var year="",month="",day="",week="",hour="",minute="",second="";
            year=date.getFullYear();
            month=add_zero(date.getMonth()+1);
            day=add_zero(date.getDate());
            week=date.getDay();
            switch (date.getDay()) {
                case 0:val="周日";break;
                case 1:val="周一";break;
                case 2:val="周二";break;
                case 3:val="周三";break;
                case 4:val="周四";break;
                case 5:val="周五";break;
                case 6:val="周六";break;
            }
            hour=add_zero(date.getHours());
            minute=add_zero(date.getMinutes());
            second=add_zero(date.getSeconds());
            document.getElementById("timetable").innerHTML=" "+year+"-"+month+"-"+day+" "+hour+":"+minute+":"+second+" "+val;
        }

        function add_zero(temp)
        {
            if(temp<10) return "0"+temp;
            else return temp;
        }
        setInterval("get_time()",1000);
    </script>
<?php
//加载公共底部文件
$this->load->view("admin/common/footer");
?>