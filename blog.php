<!DOCTYPE html>
<html lang="en">

<?php include("./include/header.php");?>

<body>

    <?php include("./include/navbar.php");?>

    <div id="all" class="ThaifontBangnam ContentTxt">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li>
                            <?php include("./include/content/page_breadcrumb.php");?>
                        </li>
                        <li>บทความ</li>
                    </ul>

                </div>

                <!-- *** LEFT COLUMN ***
             _________________________________________________________ -->
             
             <div class="col-sm-12" id="blog-listing">


<div class="box">

    <h1>บทความ</h1>
    <p>บทความที่คัดสรรมาจากตัวแม่ค้าเองทั้งประสบการณ์ตัวเองหรือเรื่องราวน่าสนใจจากบุคคลอื่น มีทั้งเรื่องไลพ์สไตล์การใช้ชีวิต การท่องเที่ยว ฯ ^^</p>

</div>
                <form method="post" action=""  id="blogForm">
                    <?php
                        $content_count = 0;
                        $QueryString = "SELECT count(content_id) as content_count from content";
                        $resultCount = sendQuery($QueryString);
                        while($rowsCount = mysqli_fetch_array($resultCount,MYSQLI_BOTH)) {
                            $content_count = empty($rowsCount['content_count'])? 0:$rowsCount['content_count'];                
                        }
                        
                        $QueryString = "SELECT DISTINCT r1.*,auth_account.u_name,( SELECT COUNT(content_comment.comment_id) AS comment_count FROM content_comment WHERE r1.content_id = content_comment.content_id ) AS comment_count FROM 
                        (
                        SELECT * FROM content 
                        ) r1
                        
                        LEFT JOIN content_comment ON r1.content_id = content_comment.content_id  
                        LEFT JOIN auth_account ON r1.content_create_by = auth_account.id 
                        ORDER BY r1.content_create_date DESC
                        ";
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
                                $comment_count = empty($rows['comment_count'])?'0':$rows['comment_count'];
          
                     ?>
                      

                            <div id="content_id_<?php echo $content_id;?>" class="post">
                                <h2>
                                    <a href="post.php?content_id=<?php echo $content_id;?>"><h2><?php echo $content_name;?></h2></a>
                                </h2>
                                <p class="author-category">By
                                    <!-- <a href="#">John Slim</a> in
                                    <a href="">Fashion and style</a> -->
                                    <?php echo $content_create_by;?>
                                </p>
                                <hr>
                                <p class="date-comments">
                                    <a href="post.php?content_id=<?php echo $content_id;?>">
                                        <i class="fa fa-calendar-o"></i> <?php echo $content_create_date;?></a>
                                    <a href="post.php?content_id=<?php echo $content_id;?>">
                                        <i class="fa fa-comment-o"></i> <?php echo $comment_count;?> Comments</a>
                                </p>
                                <div class="image" align="center">
                                    <a href="post.php?content_id=<?php echo $content_id;?>">
                                        <img src="img/blog/<?php echo $content_img1;?>" class="img-responsive" alt="<?php echo $content_name;?>">
                                    </a>
                                </div>
                                <p class="intro">&nbsp;&nbsp;<b><?php echo $content_preface;?></b></p>
                                <p class="read-more">
                                    <a href="post.php?content_id=<?php echo $content_id;?>" class="btn btn-primary ThaifontBangnam ContentTxt">อ่านต่อคลิ๊กเลย</a>
                                </p>
                            </div>

                        
                        <?php 
                                }
                        ?>

                </form>

                <ul class="pager">
                                <li id="lipreviousId" class="previous">
                                    <a id="previousId" href="#">&larr; Older</a>
                                </li>
                                <li id="linextId" class="next">
                                    <a id="nextId" href="#">Newer &rarr;</a>
                                </li>
                            </ul>
                <!-- /.col-md-9 -->
                </div>
                <!-- *** LEFT COLUMN END *** -->



            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->



        <?php  include("./include/copyright.php");?>



    </div>
    <!-- /#all -->
</body>

<script>
    pageSize = 2;
    pagesCount = $(".post").length;
    var currentPage = 1;
    
    /////////// PREPARE NAV ///////////////
    var totalPages = Math.ceil(pagesCount / pageSize);
    
    //////////////////////////////////////

    showPage = function() {
        $(".post").hide().each(function(n) {
            if (n >= pageSize * (currentPage - 1) && n < pageSize * currentPage)
                $(this).show();
        });

        if(currentPage == 1){
            $(".next").hide();
        } else {
            $(".next").show();
        }

        if(currentPage == totalPages){
            $(".previous").hide();
        } else {
            $(".previous").show();
        }
    }
    showPage();

    $(".pager li.next").click(function() {
        if($(this).next().is('.active')) return;
       
        currentPage = currentPage > 1 ? (currentPage-1) : 1;
    
        showPage();
    });

    $(".pager li.previous").click(function() {
        if($(this).prev().is('.active')) return;   
        currentPage = currentPage < totalPages ? (currentPage+1) : totalPages;
        
        showPage();
    });
</script>
</html>