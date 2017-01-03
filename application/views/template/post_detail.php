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
                    <li><a href="#"  class="active">首页</a></li>
                    <li><a href="#">关于我们</a></li>
                    <li><a href="#">新闻相册</a></li>
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
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">	Richard Spark</h4>
                        <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs .  </p>
                    </div>
                    <div class="media-right">
                        <a href="#">
                            <img src="/static/template/images/si.png" alt=""> </a>
                    </div>
                </div>
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img src="images/si.png" alt="">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Joseph Goh</h4>
                        <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs .  </p>
                    </div>
                </div>
            </div>
            <div class="comment-bottom heading">
                <h3>Leave a Comment</h3>
                <form>
                    <input type="text" value="Name" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Name';}">
                    <input type="text" value="Email" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Email';}">
                    <input type="text" value="Subject" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Subject';}">
                    <textarea cols="77" rows="6" value=" " onfocus="this.value='';" onblur="if (this.value == '') {this.value = 'Message';}">Message</textarea>
                    <input type="submit" value="Send">
                </form>
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
<!--footer-end-->
</body>
</html>
