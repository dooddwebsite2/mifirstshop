<?php 
        $cate_id = empty($_GET['cate_id']) ? 0 : $_GET['cate_id'];
        $sub_cate_active = empty($_GET['sub_cate_id']) ? '' : $_GET['sub_cate_id'];
        $cate_Arr = getSubCategory($cate_id,'','');
        $sub_cate_active_name = empty($_GET['sub_cate_id']) ? '' : $cate_Arr[$cate_id]['child'][$sub_cate_active]['sub_cate_name_th'];
        
        $cate_information = array();
        $cate_information = array_shift(array_values($cate_Arr));
        
         
?>