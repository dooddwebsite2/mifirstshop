 <!-- *** BLOG HOMEPAGE ***
 _________________________________________________________ -->

            <div class="box text-center ThaifontBangnam" data-animate="fadeInUp">
                <div class="container">
                    <div class="col-md-12">
                        <h1 class="text-uppercase">บทความ</h1>

                        <h2 class="lead">บทความทั้งหมดไม่ว่าจะเป็น ไลพ์สไตล์,การท่องเที่ยว,เครื่องประดับชิคๆ ฯ รวบรวมอยู่ที่นี่เลยค้าาา <a href="blog.php">คลิ๊กเล้ยยย !</a>
                        </h2>
                    </div>
                </div>
            </div>

            <div class="container ThaifontBangnam ContentTxt">

                <div class="col-md-12" data-animate="fadeInUp">

                    <div id="blog-homepage" class="row">
                        <?php
                    $QueryString = "SELECT * FROM content ORDER BY content.content_create_date DESC LIMIT 0,2";
                        $resultStr = sendQuery($QueryString);
                    

                        while($rows = mysqli_fetch_array($resultStr,MYSQLI_BOTH)) {

                            
                                $content_id = empty($rows['content_id'])?'-':$rows['content_id'];
                                $content_name = empty($rows['content_name'])?'-':$rows['content_name'];
                                $content_preface = empty($rows['content_preface'])?'-':$rows['content_preface'];
                                $content_html = empty($rows['content_html'])?'-':$rows['content_html'];
                                $content_paragraph1 = empty($rows['content_paragraph1'])?'-':$rows['content_paragraph1'];
                                $content_paragraph2 = empty($rows['content_paragraph2_id'])?'-':$rows['content_paragraph2_id'];
                                $content_paragraph3 = empty($rows['content_paragraph3'])?'-':$rows['content_paragraph3'];
                                $content_img1 = empty($rows['content_img1'])?'-':$rows['content_img1'];
                                $content_img2 = empty($rows['content_img2'])?'-':$rows['content_img2'];
                                $content_img3 = empty($rows['content_img3'])?'-':$rows['content_img3'];
                                $content_header_level2 = empty($rows['content_header_level2'])?'-':$rows['content_header_level2'];
                                $content_header_level3 = empty($rows['content_header_level3'])?'-':$rows['content_header_level3'];
                                $content_create_by = empty($rows['content_create_by'])?'-':$rows['content_create_by'];
                                $content_create_date = empty($rows['content_create_date'])?'-':$rows['content_create_date'];
                                $comment_count = empty($rows['comment_count'])?'0':$rows['comment_count'];

                                if( strlen( $content_name) > 300) {
                                    $str = explode( "\n", wordwrap( $content_name, 300));
                                    $content_name = $str[0] . '...';
                                }

                                if( strlen( $content_preface) > 500) {
                                    $str = explode( "\n", wordwrap( $content_preface, 500));
                                    $content_preface = $str[0] . '...';
                                }
                                
                     ?>
                        <div class="col-sm-6">
                            <div class="post">
                                <h2><a href="post.php?content_id=<?php echo $content_id;?>" alt="<?php echo $content_name;?>"><?php echo $content_name;?></a></h2>
                                <p class="author-category">By <?php echo $content_create_by;?>
                                </p>
                                <hr>
                                <p class="intro">&nbsp;&nbsp;<?php echo $content_preface;?></p>
                                <p class="read-more"><a href="post.php?content_id=<?php echo $content_id;?>" class="btn btn-primary ThaifontBangnam ContentTxt">อ่านต่อคลิ๊กเลย</a>
                                </p>
                            </div>
                        </div>

                     <?php
                        }
                        ?>

                    </div>
                    <!-- /#blog-homepage -->
                </div>
            </div>
            <!-- /.container -->

            <!-- *** BLOG HOMEPAGE END *** -->