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
<!-- script-for-menu -->
<!--banner-starts-->
<div class="banner">
    <div class="container">
        <div class="banner-top">
            <div class="banner-text">
                <h2>Aliquam erat</h2>
                <h1>Suspendisse potenti</h1>
                <div class="banner-btn">
                    <a href="single.html">Read More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--about-starts-->
<div class="about">
    <div class="container">
        <div class="about-main">
            <div class="col-md-8 about-left">
                <div class="about-tre">
                    <?php
                    foreach($post as $value){ ?>
                        <div class="a-1">
                            <div class="col-md-6 abt-left">
                                <a href="/index.php/web/post_detail/<?php echo $value['id']; ?>"><img src="/static/template/images/c-3.jpg" alt="" /></a>
                                <h6>Find The Most</h6>
                                <h3><a href="single.html">Tasty Coffee</a></h3>
                                <p>Vivamus interdum diam diam, non faucibus tortor consequat vitae. Proin sit amet augue sed massa pellentesque viverra. Suspendisse iaculis purus eget est pretium aliquam ut sed diam.</p>
                                <label>May 29, 2015</label>
                            </div>
                            <div class="col-md-6 abt-left">
                                <a href="single.html"><img src="/static/template/images/c-4.jpg" alt="" /></a>
                                <h6>Find The Most</h6>
                                <h3><a href="single.html">Tasty Coffee</a></h3>
                                <p>Vivamus interdum diam diam, non faucibus tortor consequat vitae. Proin sit amet augue sed massa pellentesque viverra. Suspendisse iaculis purus eget est pretium aliquam ut sed diam.</p>
                                <label>May 29, 2015</label>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php } ?>
                </div>
                <div class="banner-btn">
                    <a href="single.html">Read More</a>
                </div>
            </div>
            <div class="col-md-4 about-right heading">
                <div class="abt-2">
                    <h3>热门新闻</h3>
                    <div class="might-grid">
                        <div class="grid-might">
                            <a href="single.html"><img src="images/c-12.jpg" class="img-responsive" alt=""> </a>
                        </div>
                        <div class="might-top">
                            <h4><a href="single.html">Duis consectetur gravida</a></h4>
                            <p>Nullam non magna lobortis, faucibus erat eu, consequat justo. Suspendisse commodo nibh odio.</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="might-grid">
                        <div class="grid-might">
                            <a href="single.html"><img src="images/c-10.jpg" class="img-responsive" alt=""> </a>
                        </div>
                        <div class="might-top">
                            <h4><a href="single.html">Duis consectetur gravida</a></h4>
                            <p> Nullam non magna lobortis, faucibus erat eu, consequat justo. Suspendisse commodo nibh odio.</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="might-grid">
                        <div class="grid-might">
                            <a href="single.html"><img src="images/c-11.jpg" class="img-responsive" alt=""> </a>
                        </div>
                        <div class="might-top">
                            <h4><a href="single.html">Duis consectetur gravida</a></h4>
                            <p> Nullam non magna lobortis, faucibus erat eu, consequat justo. Suspendisse commodo nibh odio.</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="abt-2">
                    <h3>评论最多</h3>
                    <ul>
                        <li><a href="single.html">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </a></li>
                        <li><a href="single.html">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</a></li>
                        <li><a href="single.html">When an unknown printer took a galley of type and scrambled it to make a type specimen book. </a> </li>
                        <li><a href="single.html">It has survived not only five centuries, but also the leap into electronic typesetting</a> </li>
                        <li><a href="single.html">Remaining essentially unchanged. It was popularised in the 1960s with the release of </a> </li>
                        <li><a href="single.html">Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing </a> </li>
                        <li><a href="single.html">Software like Aldus PageMaker including versionsof Lorem Ipsum.</a> </li>
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
            <p>Copyright &copy; 2015.Company name All rights reserved.More Templates  - Collect from</p>
        </div>
    </div>
</div>
<!--footer-end-->
</body>
</html>
