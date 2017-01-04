<?php
/**
 * Description：网站首页
 * Author: LNC
 * Date: 2017/1/2
 * Time: 17:13
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title>文章详情</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="溪话工作室" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="/static/template/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="/static/template/css/style.css" rel='stylesheet' type='text/css' />
    <script src="/static/template/js/jquery.min.js"></script>
    <!---- start-smoth-scrolling---->
    <script type="text/javascript" src="/static/template/js/move-top.js"></script>
    <script type="text/javascript" src="/static/template/js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
    <!--start-smoth-scrolling-->
</head>
<body>
<!--start-header-->
<div class="header">
    <div class="container">
        <div class="head">
            <div class="navigation">
                <span class="menu"></span>
                <ul class="navig">
                    <li><a href="/"  class="active">首页</a></li>
                    <li><a href="#">关于我们</a></li>
                    <li><a href="#">新闻中心</a></li>
                    <li><a href="#">联系我们</a></li>
                </ul>
            </div>
            <div class="header-right">
                <div class="search-bar">
                    <input type="text" value="Search" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Search';}">
                    <input type="submit" value="">
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- script-for-menu -->
<!-- script-for-menu -->
<script>
    $("span.menu").click(function(){
        $(" ul.navig").slideToggle("slow" , function(){
        });
    });
</script>
<div class="single">
    <div class="container">
        <div class="single-top">
            <a href="#"><img class="img-responsive" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$post['post_pic']?>" alt=" "></a>
            <div class=" single-grid">
                <h4><?php echo $post['post_title']?></h4>
                <ul class="blog-ic">
                    <li><a href="#"><span> <i  class="glyphicon glyphicon-user"> </i><?php echo $post['post_author']?></span> </a> </li>
                    <li><span><i class="glyphicon glyphicon-time"> </i><?php echo $post['create_time']?></span></li>
                    <li><span><i class="glyphicon glyphicon-eye-open"> </i><?php echo $post['read_time']?></span></li>
                </ul>
                <?php echo $post['post_content']?>
            </div>
            <div class="comments heading">
                <h3>评论</h3>
                <?php
                foreach($comment as $item){ ?>
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img src="/static/template/images/si.png" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $item['name']; ?></h4>
                            <p><?php echo $item['comment']; ?></p>
                        </div>
                    </div>
                <?php }
                ?>


            </div>
            <div class="comment-bottom heading">
                <h3>留个言了再走吧。</h3>
                <div style="    width: 70%; margin-top: 3%;">
                <input type="text" value="姓名" id="name" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='姓名';}">
                <input type="text" value="邮箱" id="email" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='邮箱';}">
                <textarea cols="77" rows="6" id="content" onfocus="this.value='';" onblur="if (this.value == '') {this.value = '评论';}">评论</textarea>
                <button style="color: #fff; padding: 9px 42px;font-size: 15px;background: #190608;cursor: pointer;font-weight: 500;margin: 20px 0 0 0px;border: none;font-family: 'Lato', sans-serif;outline: none; border-radius: 5px;-webkit-border-radius: 5px" onclick="submit_(<?php echo $post['id']?>)">发送</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--footer-starts-->
<div class="footer">
    <div class="container">
        <div class="footer-text">
            <p>Copyright &copy; 2015.溪话工作室 All rights reserved.</p>
        </div>
    </div>
</div>
<script>
    function submit_(post_id){
        if(!post_id){
            alert('文章ID不能为空');
            return;
        }
        var name = $('#name').val();
        var email = $('#email').val();
        var content = $('#content').val();
        if(!name || name == '姓名'){
            alert('姓名不能为空');
            return;
        }
        if(!email || email == '邮箱'){
            alert('邮箱不能为空');
            return;
        }
        if(!email.match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/)) {
            alert('邮箱格式不正确！');
            return;
        }
        if(!content || content == '评论'){
            alert('评论不能为空');
            return;
        }
        var data =  {
            post_id:post_id,
            name:name,
            email:email,
            content:content
        };
        $.ajax({
            async:false,
            type : 'POST',
            url: '/index.php/web/add_comment',
            data : data,
            dataType : 'json',
            success: function (data)
            {
                if (data.result == '0000') {
                    alert('评论成功，等待管理员审核通过吧！');
                    location.reload();
                } else {
                    alert(data.info);
                }
            }
        });
    }
</script>
<!--footer-end-->
</body>
</html>
