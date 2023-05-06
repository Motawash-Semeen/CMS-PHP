<?php
include('./includes/db.php');
?>
<?php
include('./includes/header.php');
?>
<!-- Navigation -->
<?php
include('./includes/navigation.php');
?>



<!-- PAGINATION PHP -->
<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = "";
}
if ($page == "" || $page == 1) {
    $page_1 = 0;
} else {
    $page_1 = ($page * 5) - 5;
}
?>
<?php
$sql_count = "SELECT * FROM posts WHERE post_status = 'active'";
$result_count = $conn->query($sql_count);
$count = mysqli_num_rows($result_count);
$count = ceil($count / 5);
?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                MS Blog
                <small>Home Page</small>
            </h1>

            <?php
            $sql_post = "SELECT * FROM posts WHERE post_status = 'active' ORDER BY post_date DESC LIMIT $page_1, 5";
            $result_post = $conn->query($sql_post);


            if ($result_post->num_rows > 0) {
                while ($row = $result_post->fetch_array()) {
                    $short_content = substr($row['post_content'], 0, 200) . '...';

                    echo "<h2>
                        <a href='post.php?p_id={$row['post_id']}'>{$row['post_title']}</a>
                    </h2>
                    <p class='lead'>
                        by <a href='authorposts.php?author={$row['post_author']}&p_id={$row['post_id']}'>{$row['post_author']}</a>
                    </p>
                    <p><span class='glyphicon glyphicon-time'></span> Posted on {$row['post_date']}</p>
                    <hr>
                    <a href='post.php?p_id={$row['post_id']}'>
                                        <img class='img-responsive' src='./admin/images/{$row['post_img']}' alt='{$row['post_img']}' width='900' height='300'>
                    </a>
                    <hr>
                    <p>{$short_content}</p>
                    <a class='btn btn-primary' href='post.php?p_id={$row['post_id']}'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
        
                    <hr>";
                }
            } else {
                echo "<h3 style='text-align:center'>No Post Found</h3>";
            }
            ?>


            <!-- Pager -->
            <div>
                <ul class="pagination justify-content-end">
                    <!-- <li class="active"><a href="#">2</a></li> -->
                    <?php
                    for ($i = 1; $i <= $count; $i++) {
                        echo " <li><a href='index.php?page=$i'>$i</a></li>";
                    }
                    ?>
                </ul>
            </div>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php
        include('./includes/sidebar.php');
        ?>
    </div>
    <!-- /.row -->

    <hr>


    <?php
    include('./includes/footer.php');
    ?>