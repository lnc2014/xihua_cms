<?php
/**
 * Description：分页公共页面
 * Author: LNC
 * Date: 2017/1/3
 * Time: 23:22
 */
?>
<div class="row">
    <div class="col-xs-6">
        <div class="dataTables_info" id="sample-table-2_info">共 <?php echo $all_record ?> 条记录</div>
    </div>
    <div class="col-xs-6">
        <div class="dataTables_paginate paging_bootstrap">
            <ul class="pagination">
                <li class="prev <?php  if($page == 1){ echo 'disabled'; }?>">
                    <a href="<?php echo $url;?>?page=1">
                        <i class="fa fa-angle-double-left"></i>
                    </a>
                </li>
                <li class="prev <?php  if($page == 1){ echo 'disabled'; }?>">
                    <a href="
                    <?php  if($page == 1){ echo '#'; }else{ ?>
                            <?php echo $url;?>?page=<?php echo $page-1; ?>
                    <?php }?> ">
                        <i class="fa fa-angle-left"></i>
                    </a>
                </li>
                <?php
                for($i=1;$i<=$pages;$i++){ ?>
                    <li  class="<?php if($i == $page){ echo 'active'; } ?>"><a href="<?php echo $url?>?page=<?php echo $i?>"><?php echo $i?></a></li>
                <?php }?>
                <li class="next <?php  if($page == $pages){ echo 'disabled'; }?>">
                    <a href="
                    <?php  if($page == $pages){ echo '#'; }else{ ?>
                    <?php echo $url;?>?page=<?php echo $page+1; ?>
                    <?php }?> ">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
                <li class="next <?php  if($page == $pages){ echo 'disabled'; }?>">
                    <a href="
                    <?php  if($page == $pages){ echo '#'; }else{ ?>
                    <?php echo $url;?>?page=<?php echo $pages; ?>
                    <?php }?>
                    "><i class="fa fa-angle-double-right"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>
