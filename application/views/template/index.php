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
    <title>首页</title>
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
    <script type="text/javascript" src="/static/template/js/bootstrap.min.js"></script>
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
<!-- script-for-menu -->
<!--banner-starts-->
<?php
if(!empty($banner)){ ?>
    <div class="banner">
        <div class="container">
            <div id="myCarousel" class="carousel slide">
                <!-- 轮播（Carousel）指标 -->
                <ol class="carousel-indicators">
                    <?php
                    foreach($banner as $k=>$item1){ ?>
                        <li data-target="#myCarousel" data-slide-to="<?php echo $k;?>" <?php if($k == 0){ echo 'class="active"';}?>></li>
                    <?php  }
                    ?>
                </ol>
                <!-- 轮播（Carousel）项目 -->
                <div class="carousel-inner">
                    <?php
                    foreach($banner as $k => $item){ ?>
                        <div class="item <?php if($k == 0){ echo 'active';}?>">
                            <img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$item['banner']; ?>" alt="<?php echo $item['title']; ?>">
                        </div>
                   <?php  }
                    ?>
                </div>
                <!-- 轮播（Carousel）导航 -->
                <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;
                </a>
                <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;
                </a>
            </div>
        </div>
    </div>
<?php }
?>
<!--about-starts-->
<div class="about">
    <div class="container">
        <div class="about-main">
            <div class="col-md-8 about-left">
                <div class="about-tre">
                        <div class="a-1">
                            <?php
                            for($i = 0; $i<count($all_posts); $i++){ ?>
                                <?php
                                if($i%2 == 0){ ?>
                                    <div class="col-md-6 abt-left">
                                        <a href="/index.php/web/post_detail/<?php echo $all_posts[$i]['id']; ?>"><img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$all_posts[$i]['post_pic']?>" alt="" /></a>
                                        <h3><a href="/index.php/web/post_detail/<?php echo $all_posts[$i]['id']; ?>"><?php echo $all_posts[$i]['post_title'];?></a></h3>
                                        <p><?php echo $all_posts[$i]['post_intro'];?></p>
                                        <label><?php echo $all_posts[$i]['create_time'];?></label>
                                    </div>
                                    <?php
                                    if(!empty($all_posts[$i+1])){ ?>
                                    <div class="col-md-6 abt-left">
                                        <a href="/index.php/web/post_detail/<?php echo $all_posts[$i+1]['id']; ?>"><img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$all_posts[$i+1]['post_pic']?>" alt="" /></a>
                                        <h3><a href="/index.php/web/post_detail/<?php echo $all_posts[$i+1]['id']; ?>"><?php echo $all_posts[$i+1]['post_title'];?></a></h3>
                                        <p><?php echo $all_posts[$i+1]['post_intro'];?></p>
                                        <label><?php echo $all_posts[$i+1]['create_time'];?></label>
                                    </div>
                                        <?php }?>
                                    <div class="clearfix"></div>
                                <?php }
                            }
                            ?>
                        </div>
                </div>
                <div class="banner-btn">
                    <a href="">Read More</a>
                </div>
            </div>
            <div class="col-md-4 about-right heading">
                <div class="abt-2">
                    <h3>热门新闻</h3>
                    <?php
                    foreach($all_posts_read as $read){ ?>
                        <div class="might-grid">
                            <div class="grid-might">
                                <a href="/index.php/web/post_detail/<?php echo $read['id']?>">
                                    <img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$read['post_pic']?>" class="img-responsive" alt="">
                                </a>
                            </div>
                            <div class="might-top">
                                <h4><a href="/index.php/web/post_detail/<?php echo $read['id']?>"><?php echo $read['post_title'];?></a></h4>
                                <p><?php echo $read['post_intro'];?></p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php }
                    ?>
                </div>
                <div class="abt-2">
                    <h3>评论最多</h3>
                    <ul>
                        <?php
                        foreach($all_posts_comment as $comment){ ?>
                        <li><a href="/index.php/web/post_detail/<?php echo $comment['id']?>">
                                <?php echo $comment['post_title'];?>
                            </a></li>
                        <?php }?>

                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--about-end-->
<!--slide-starts-->
<div class="slide">
    <div class="container">
        <div class="fle-xsel">
            <ul id="flexiselDemo3">
                <li>
                    <a href="#">
                        <div class="banner-1">
                            <img src="/static/template/images/s-1.jpg" class="img-responsive" alt="">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="banner-1">
                            <img src="/static/template/images/s-2.jpg" class="img-responsive" alt="">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="banner-1">
                            <img src="/static/template/images/s-3.jpg" class="img-responsive" alt="">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="banner-1">
                            <img src="/static/template/images/s-4.jpg" class="img-responsive" alt="">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="banner-1">
                            <img src="/static/template/images/s-5.jpg" class="img-responsive" alt="">
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="banner-1">
                            <img src="/static/template/images/s-6.jpg" class="img-responsive" alt="">
                        </div>
                    </a>
                </li>
            </ul>

            <script type="text/javascript">
                $(window).load(function() {

                    $("#flexiselDemo3").flexisel({
                        visibleItems: 5,
                        animationSpeed: 1000,
                        autoPlay: true,
                        autoPlaySpeed: 3000,
                        pauseOnHover: true,
                        enableResponsiveBreakpoints: true,
                        responsiveBreakpoints: {
                            portrait: {
                                changePoint:480,
                                visibleItems: 2
                            },
                            landscape: {
                                changePoint:640,
                                visibleItems: 3
                            },
                            tablet: {
                                changePoint:768,
                                visibleItems: 3
                            }
                        }
                    });

                });
            </script>
            <script type="text/javascript" src="/static/template/js/jquery.flexisel.js"></script>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!--slide-end-->
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
