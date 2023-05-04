<?php
include('./includes/db.php');
?>
<?php
include('./includes/header.php');
?>
<?php
if (isset($_GET['author'])) {
    $name = $_GET['author'];
    $sql_author = "SELECT * FROM posts WHERE post_author LIKE '$name'";
    $result_author = $conn->query($sql_author);
}

?>
<!-- Navigation -->
<?php
include('./includes/navigation.php');
?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                <?php echo $name ; ?>
                <small>Secondary Text</small>
            </h1>

            <?php


            if ($result_author->num_rows > 0) {
                while ($row = $result_author->fetch_array()) {
                    if ($row['post_status'] == 'active') {
                        $short_content = substr($row['post_content'], 0, 200) . '...';

                        echo "<h2>
                            <a href='post.php?p_id={$row['post_id']}'>{$row['post_title']}</a>
                        </h2>
                        <p class='lead'>
                            by <a href='authorposts.php?author={$row['post_author']}&p_id={$row['post_id']}'>{$row['post_author']}</a>
                        </p>
                        <p><span class='glyphicon glyphicon-time'></span> Posted on {$row['post_date']}</p>
                        <hr>
                        <a href='post.php?p_id={$row['post_id']}'><img class='img-responsive' src='./admin/images/{$row['post_img']}' alt='{$row['post_img']}'  width='900' height='300'></a>
                        
                        <hr>
                        <p>{$short_content}</p>
                        <a class='btn btn-primary' href='post.php?p_id={$row['post_id']}'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>
                
                        <hr>";
                    }
                }
            } else {
                echo "<h2>Not found</h2>";
            }

            ?>

            <!-- First Blog Post -->
            <!-- <h2>
                <a href="#">Blog Post Title</a>
            </h2>
            <p class="lead">
                by <a href="index.php">Start Bootstrap</a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:00 PM</p>
            <hr>
            <img class="img-responsive" src="http://placehold.it/900x300" alt="">
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus
                inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum
                officiis rerum.</p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr> -->



            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

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