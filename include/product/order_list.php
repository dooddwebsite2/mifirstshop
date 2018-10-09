<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">สินค้า</th>
                                            <th>จำนวน</th>
                                            <th>ราคาต่อหน่วย&nbsp;(฿)</th>
                                            <th>ลดราคา&nbsp;(%)</th>
                                            <th align="center" colspan="1">รวม&nbsp;(฿)</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // get product from session
                                        foreach($_SESSION['cart']['product'] as $_keys => $_vals){
                                            $prodArrays = getProduct($_vals,' product_create_date DESC',1,'','');
                                            $img1 = empty($prodArrays[$_vals]["product_img1"]) ? 'no_image.png' : $prodArrays[$_vals]["product_img1"];
                                            $img1_path = empty($prodArrays[$_vals]["product_img1"]) ? 'img/'.$img1 : 'img/product/'.$_vals.'/'.$img1;
                                            
                                            $percents = empty($prodArrays[$_vals]['product_discount']) ? 0 : $prodArrays[$_vals]['product_discount'];
                                            if(isset($_SESSION['cart']['orders'][$_vals]))
                                            {
                                                $price = $_SESSION['cart']['orders'][$_vals]['value'];
                                                $amount = $_SESSION['cart']['orders'][$_vals]['amount'];
                                            }else{
                                                $price = empty($prodArrays[$_vals]['product_price']) ? 0 : $prodArrays[$_vals]['product_price'];
                                                $amount = 1;
                                            }
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="#">
                                                    <img src="<?php echo $img1_path;?>" alt="White Blouse Armani">
                                                </a>
                                            </td>
                                            <td><a href="#"><?php echo $prodArrays[$_vals]['product_name'].'&nbsp;(คงเหลือในสต็อค&nbsp;'.$prodArrays[$_vals]['product_stock']. ')';?></a>
                                            </td>
                                            <td>
                                                <input id="input_amout_<?php echo $_vals;?>" onchange="cal_sums(<?php echo $_vals;?>,<?php echo $percents;?>,<?php echo $prodArrays[$_vals]['product_price'];?>,<?php echo $prodArrays[$_vals]['product_stock'];?>)" type="number" value="<?php echo $amount;?>" min="0" max="<?php echo $prodArrays[$_vals]['product_stock'];?>"  hidden_id="<?php echo $_vals;?>" class="form-control input_amount" <?php echo $amount_disabled == true ? 'disabled' : '';?>>
                                            </td>
                                            <td><span><?php echo $prodArrays[$_vals]['product_price'].'';?></span></td>
                                            <td><span><?php echo empty($prodArrays[$_vals]['product_discount']) ? 0 : $prodArrays[$_vals]['product_discount'];?></span></td>
                                            <td><input id="sums_<?php echo $_vals;?>"  class="sum_input input_sum" hidden_id="<?php echo $_vals;?>"  style="text-align: left; " value="<?php echo $price.'';?>" disabled></td>
                                            
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                 
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4">รวม</th>
                                            <th colspan="2"><input id="footer_sums" class="input_sum" style="text-align:right;" value="" disabled></th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <!-- /.table-responsive -->