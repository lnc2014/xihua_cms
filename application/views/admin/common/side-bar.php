<?php
/**
 * Author:LNC
 * Description: 右侧导航栏，权限控制
 * Date: 2016/12/25 0025
 * Time: 下午 2:23
 */
?>
<div id="sidebar" class="sidebar responsive">
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>

            <!-- #section:basics/sidebar.layout.shortcuts -->
            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>
            <!-- /section:basics/sidebar.layout.shortcuts -->
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->

    <ul class="nav nav-list">
        <li <?php
        if($active == 'home'){ echo 'class="active"'; } ?>>
            <a href="/index.php/admin/home/index">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text">后台首页</span>
            </a>
            <b class="arrow"></b>
        </li>

        <li <?php if($active == 'post'){ echo 'class="active"'; } ?>>
            <a href="/index.php/admin/post/index" class="dropdown-toggle">
                <i class="menu-icon fa fa-pencil-square-o"></i>
                <span class="menu-text">内容管理</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li <?php if($active_second == 'cate_index'){ echo 'class="active"'; } ?>>
                    <a href="/index.php/admin/post/cate_list">
                        <i class="menu-icon fa fa-caret-right"></i>
                        文章分类列表
                    </a>
                    <b class="arrow"></b>
                </li>
                <li <?php if($active_second == 'add_cate'){ echo 'class="active"'; } ?>>
                    <a href="/index.php/admin/post/add_post_cate">
                        <i class="menu-icon fa fa-caret-right"></i>
                        增加文章分类列表
                    </a>
                    <b class="arrow"></b>
                </li>
                <li <?php if($active_second == 'post_index'){ echo 'class="active"'; } ?>>
                    <a href="/index.php/admin/post/index">
                        <i class="menu-icon fa fa-caret-right"></i>
                        文章列表
                    </a>
                    <b class="arrow"></b>
                </li>
                <li <?php if($active_second == 'add_post'){ echo 'class="active"'; } ?>>
                    <a href="/index.php/admin/post/add_post">
                        <i class="menu-icon fa fa-caret-right"></i>
                        新增文章
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
        </li>
        <li <?php if($active == 'comment'){ echo 'class="active"'; } ?>>
            <a href="/index.php/admin/post/comment">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text">评论管理</span>
            </a>
            <b class="arrow"></b>
        </li>
        <li <?php if($active == 'banner'){ echo 'class="active"'; } ?>>
            <a href="/index.php/admin/home/banner">
                <i class="menu-icon fa fa-picture-o"></i>
                <span class="menu-text">banner图管理</span>
            </a>
            <b class="arrow"></b>
        </li>
    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
    </script>
</div>
