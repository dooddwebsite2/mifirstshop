<a href="#"  onclick="add_to_cart(<?php echo $u_id;?>,<?php echo $product_id?>)" class="btn btn-primary" class="<?php echo array_search("{$product_id}",$_SESSION['cart']['product']) ? 'btn btn-primary disabled ' : 'btn btn-primary';?>">
<i class="fa fa-shopping-cart"></i>เพิ่มลงตระกร้า</a>