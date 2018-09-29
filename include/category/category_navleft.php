
<div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">หมวดหมู่</h3>
                        </div>

<div class="panel-body">
    <ul class="nav nav-pills nav-stacked category-menu">
     
        <?php
            foreach ($cate_Arr as $parent_id => $sub_cate) {
                                       
        ?>
            <li class="<?php if(!empty($cate_id) && empty($sub_cate_active)) echo 'active';?>">
                <a href="category.php?cate_id=<?php echo $parent_id;?>">
                    <?php echo $cate_Arr[$parent_id]['parent_name_th'];?>
                    <?php
                    $count_parent_category = count(getProduct_withCategory('', $parent_id,'' ,'','','','','')) > 0 ? count(getProduct_withCategory('', $parent_id,'' ,'','','','','')) : 0 ;
                    

                    ?>
                    <span class="badge pull-right"><?php echo $count_parent_category;?></span>
                </a>
                <ul>
                    <?php
                        if(!empty($cate_Arr[$parent_id]['child']) && !isset($cate_Arr[$parent_id]['child'][0])){
                        
                            foreach($cate_Arr[$parent_id]['child'] as $sub_key => $sub_cate_value ){
                            $sub_cate_name = $cate_Arr[$parent_id]['child'][$sub_key]['sub_cate_name_th'];
                        ?>
                        <li class="<?php if(!empty($sub_cate_active) && $sub_cate_active == $sub_key){ echo 'liActiveClass';}?>">
                            <a class="<?php if(!empty($sub_cate_active) && $sub_cate_active == $sub_key){ echo 'liActiveClassA';}?>" href="category.php?cate_id=<?php echo $parent_id; ?>&sub_cate_id=<?php echo $sub_key;?>">
                                <?php echo $sub_cate_name;?>
                            </a>
                        </li>
                        <?php
                            }
                        }
                        ?>
                </ul>
            </li>
            <?php
                                    }
                                ?>


    </ul>
    
</div>


</div>

<!-- WEB BANNER !-->
<div class="banner">
    <a href="#">
        <img src="img/banner1.jpg" alt="sales 2014" class="img-responsive">
    </a>
</div>

<div class="banner">
    <a href="#">
        <img src="img/banner1.jpg" alt="sales 2014" class="img-responsive">
    </a>
</div>

<div class="banner">
    <a href="#">
        <img src="img/banner1.jpg" alt="sales 2014" class="img-responsive">
    </a>
</div>

