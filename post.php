<!DOCTYPE html>
<html lang="en">

<?php include("./include/header.php");?>

<body>

    <?php include("./include/navbar.php");?>

    <div id="all" class="ThaifontBangnam ContentTxt">

        <div id="content">
            <div class="container">

                <div class="col-sm-12">

                    <ul class="breadcrumb">


                        <li>
                            <?php include("./include/content/page_breadcrumb.php");?>
                        </li>

                        <li>
                            <a href="blog.php">บทความ</a>
                        </li>
                        <li>โพสต์บนบล็อก</li>
                    </ul>
                </div>

                <div class="col-sm-12" id="blog-post">


                    <div class="box">
                        <?php
                        $_content_id = isset($_GET['content_id'])? $_GET['content_id'] : 0;

                        
                        $QueryString = "SELECT * FROM content  LEFT JOIN auth_account ON auth_account.id = content.content_create_by where content.content_id = {$_content_id}
                        limit 0,1 ";
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
                                $content_create_by = empty($rows['u_name'])?'-':$rows['u_name'];
                                $content_create_date = empty($rows['content_create_date'])?'-':$rows['content_create_date'];
                        }   
                        ?>
                            <h1>
                                <?php echo $content_name;?>
                            </h1>
                            <p class="author-date">By

                                <?php echo $content_create_by;?> |
                                <?php echo  $content_create_date;?>
                            </p>
                            <p class="lead">&nbsp;&nbsp;
                                <b>
                                    <?php echo $content_preface;?>
                                </b>
                            </p>

                            <div id="post-content">
                                <p>
                                    <?php echo $content_paragraph1;?>
                                </p>

                                <p align="center">
                                    <?php
                                        if($content_img1 != '-'){

                                    ?>
                                        <img src="img/blog/<?php echo $content_img1;?>" class="img-responsive" alt="<?php echo $content_name;?>">
                                        <?php
                                        }
                                    ?>
                                </p>
                                <?php
                                    if($content_header_level2 != '-'){

                                ?>
                                    <h2>
                                        <?php echo $content_header_level2;?>
                                    </h2>
                                    <?php
                                     }
                                ?>
                                        <?php
                                if($content_paragraph2 != '-'){

                                ?>
                                            <p>
                                                <?php echo $content_paragraph2;?>
                                            </p>
                                            <?php
                                }
                                ?>

                                                <p align="center">
                                                    <?php
                                        if($content_img2 != '-'){

                                    ?>
                                                        <img src="img/blog/<?php echo $content_img2;?>" class="img-responsive" alt="<?php echo $content_name;?>">
                                                        <?php
                                        }
                                    ?>
                                                </p>

                                                <?php
                                    if($content_header_level3 != '-'){

                                ?>
                                                    <h2>
                                                        <?php echo $content_header_level3;?>
                                                    </h2>
                                                    <?php
                                     }
                                ?>
                                                        <?php
                                if($content_paragraph3 != '-'){

                                ?>
                                                            <p>
                                                                <?php echo $content_paragraph3;?>
                                                            </p>
                                                            <?php
                                }
                                ?>


                                                                <p align="center">
                                                                    <?php
                                        if($content_img3 != '-'){

                                    ?>
                                                                        <img src="img/blog/<?php echo $content_img3;?>" class="img-responsive" alt="<?php echo $content_name;?>">
                                                                        <?php
                                        }
                                    ?>
                                                                </p>



                            </div>
                            <!-- /#post-content -->

                            <div id="comments" data-animate="fadeInUp">

                                <?php
                        
                        $content_count = 0;
                                    $QueryString = "SELECT count(content_id) as content_count from content_comment where content_id = {$_content_id}";
                        $resultCount = sendQuery($QueryString);
                        while($rowsCount = mysqli_fetch_array($resultCount,MYSQLI_BOTH)) {
                            $content_count = empty($rowsCount['content_count'])? 0:$rowsCount['content_count'];                
                        }
                        ?>
                                    <?php
                        if($content_count != 0) {
                        ?>
                                        <h3>
                                            <b id="tagB_commentCount">
                                                <?php echo $content_count;?> Comment</b>
                                        </h3>
                                        <?php } ?>
                                        <?php
                        $QueryString = "SELECT * FROM content_comment where content_id = {$_content_id}
                      ORDER BY comment_datetime DESC ";

                  

                        $resultStr = sendQuery($QueryString);
                        
                        while($rows = mysqli_fetch_array($resultStr,MYSQLI_BOTH)) {
                                
                        
                        $comment_count = empty($rows['comment_count'])?'0':$rows['comment_count'];
                        $comment_id = empty($rows['comment_id'])?'-':$rows['comment_id'];
                        $comment_poster_name = empty($rows['comment_poster_name'])?'-':$rows['comment_poster_name'];
                        $comment_email = empty($rows['comment_email'])?'-':$rows['comment_email'];
                        $comment_message = empty($rows['comment_message'])?'-':$rows['comment_message'];
                        $comment_datetime = empty($rows['comment_datetime'])?'-':$rows['comment_datetime'];
                        $comment_subject = empty($rows['comment_subject'])?'-':$rows['comment_subject'];
                     ?>
                                            <div class="row comment">
                                                <div class="col-sm-3 col-md-2 text-center-xs">
                                                    <p>
                                                        <img src="img/blog/person.png" class="img-responsive img-circle" alt="">
                                                    </p>
                                                </div>
                                                <div class="col-sm-9 col-md-10">
                                                    <h2>
                                                        <?php echo $comment_poster_name;?>
                                                    </h2>
                                                    <p class="posted">
                                                        <i class="fa fa-clock-o"></i>&nbsp;
                                                        <?php echo $comment_datetime;?>
                                                    </p>
                                                    <p>
                                                        <?php echo $comment_message;?>
                                                    </p>
                                                    <p class="reply">
                                                        <span style="cursor: pointer;color: #4fbfa8;text-decoration: none;" onclick="ReplyFunction('<?php echo $comment_poster_name;?>','<?php echo $comment_message;?>');">
                                                            <i class="fa fa-reply"></i>&nbsp;Reply</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <?php
                               }
                             ?>
                                                <!-- /.comment -->




                            </div>

                            <ul class="pager">
                                <li id="lipreviousId" class="previous">
                                    <a id="previousId" href="#tagB_commentCount">&larr; Older</a>
                                </li>
                                <li id="linextId" class="next">
                                    <a id="nextId" href="#tagB_commentCount">Newer &rarr;</a>
                                </li>
                            </ul>
                            <!-- /#comments -->
                            <hr id="hrshow" style="display: none;">

                            <div id="comment-form" data-animate="fadeInUp">

                                <h2>แสดงความคิดเห็น</h2>

                                <form method="post" action="" id="postForm">
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">ชื่อ
                                                    <span class="required">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="name" pattern="^[a-zA-Z 0-9ก-๙]+$" title="ไม่อนุญาตให้ใช้อักขระพิเศษ" required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="email">อีเมล์
                                                    <span class="required">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="email" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="comment">ข้อความ
                                                    <span class="required">*</span>
                                                </label>
                                                <textarea class="form-control" id="comment" title="ไม่อนุญาตให้ใช้อักขระพิเศษ" rows="4" required></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 text-right">
                                            <span class="btn btn-primary" onclick="sendRequests();">
                                                <i class="fa fa-comment-o"></i> โพสต์ข้อความ</span>
                                        </div>
                                    </div>


                                </form>

                            </div>
                            <!-- /#comment-form -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /#blog-post -->



            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

        <?php  include("./include/copyright.php");?>
    </div>
    <!-- /#all -->

    <script>
        function ReplyFunction(commentPostName, commentPost) {

            $("#comment").slideDown(function () {

                $("#name").focus();
            });

            $('#comment').val('@' + commentPostName + ' ' + '"' + commentPost + '" ');

        }


        function sendRequests() {

            var name = $('#name').val();
            var email = $('#email').val();
            var comment = $('#comment').val();
            var content_id = '<?php echo $_content_id?>';

            $('#loadingDiv').show();
            var url = './include/ajax/post_form.php';
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    name: name,
                    email: email,
                    comment: comment,
                    content_id: content_id,
                    action: "post_form"
                },
                success: function (data, status, xhr) {
                    $('#loadingDiv').hide();
                    alert('ส่งข้อมูลแล้ว');
                    location.reload();
                }
            });

        }
    </script>


    <script>
        pageSize = 2;
        pagesCount = $(".comment").length;
        var currentPage = 1;
        $(function () {
            if (pagesCount == 0) {
                $('.pager').hide();
                $('#hrshow').show();
            }
        });
        /////////// PREPARE NAV ///////////////
        var totalPages = Math.ceil(pagesCount / pageSize);

        //////////////////////////////////////

        showPage = function () {

            $(".comment").hide().each(function (n) {
                if (n >= pageSize * (currentPage - 1) && n < pageSize * currentPage)
                    $(this).show();
            });

            if (currentPage == 1) {
                $(".next").hide();
            } else {
                $(".next").show();
            }

            if (currentPage == totalPages) {
                $(".previous").hide();
            } else {
                $(".previous").show();
            }

          // $('#tagB_commentCount').scrollTop(0);
            
        }
        showPage();

        $(".pager li.next").click(function () {
            // e.preventDefault();
            if ($(this).next().is('.active')) return;
            
            currentPage = currentPage > 1 ? (currentPage - 1) : 1;

            showPage();
        });

        $(".pager li.previous").click(function () {
            // e.preventDefault();
            if ($(this).prev().is('.active')) return;
            currentPage = currentPage < totalPages ? (currentPage + 1) : totalPages;

            showPage();
        });
    </script>


</body>

</html>