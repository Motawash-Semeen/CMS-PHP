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

<?php

if (isset($_GET['p_id'])) {
    $id = $_GET['p_id'];
    $sql = "SELECT * FROM posts WHERE post_id = '$id'";
    $result = $conn->query($sql);
    $v = $result->fetch_array();
    $view = "UPDATE posts SET post_views = post_views+1 WHERE post_id = '$id'";
    $conn->query($view);

    $com_count = "SELECT * FROM comments WHERE com_post_id = '$id' AND com_status = 'approved'";
    $res_count = $conn->query($com_count);
    $count_com = mysqli_num_rows($res_count);
    $error_msg = null;
    $links = "authorposts.php?author={$v['post_author']}&p_id={$v['post_id']}";
} else {
    header("Location: index.php");
}

?>

<?php
if (isset($_GET['like'])) {
    $post_id = $_GET['p_id'];
    $u_id = $_SESSION['id'];

    $sql = "SELECT * FROM likes WHERE user_id = $u_id AND post_id = $post_id";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $sql_del = "DELETE FROM likes  WHERE user_id = $u_id AND post_id = $post_id";
        $conn->query($sql_del);

        $sql_up = "UPDATE posts SET post_likes = post_likes-1 WHERE post_id = $post_id";
        $conn->query($sql_up);
        header("Location: post.php?p_id=$post_id");
    } else {
        $sql_up = "INSERT INTO `likes`(`user_id`, `post_id`) VALUES ('$u_id','$post_id')";
        $conn->query($sql_up);
        $sql_up = "UPDATE posts SET post_likes = post_likes+1 WHERE post_id = $post_id";
        $conn->query($sql_up);
        header("Location: post.php?p_id=$post_id");
    }
}

?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">

            <!-- Blog Post -->

            <!-- Title -->
            <h1><?php echo $v['post_title'] ?></h1>

            <!-- Author -->
            <p class="lead">
                by <a href="<?php echo $links; ?>"><?php echo $v['post_author'] ?></a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $v['post_date'] ?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-responsive" src="./admin/images/<?php echo $v['post_img'] ?>" alt="" style="width: 100%">

            <hr>

            <!-- Post Content -->
            <p class="lead"><?php echo $v['post_content'] ?></p>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p> -->

            <hr>

            <?php
            if (isset($_SESSION['role'])) {
                $id = $v['post_id'];
                $u_id = $_SESSION['id'];
                $sql = "SELECT * FROM likes WHERE user_id = $u_id AND post_id = $id";
                $res = $conn->query($sql);
                if ($res->num_rows > 0) {
                    $data = 'Disike';
                } else {
                    $data = 'Like';
                }
            ?>
                <div class="row">
                    <p class="pull-right"><a class="like" href="post.php?p_id=<?php echo $id; ?>&like"><span class="glyphicon glyphicon-thumbs-up" data-placement="top"></span>
                            <?php echo $data; ?>
                        </a></p>
                </div>

            <?php  } else { ?>

                <div class="row">
                    <p class="pull-right login-to-post">You need to <a href="#login">Login</a> to like </p>
                </div>
            <?php }
            ?>

            <?php
            if (isset($_GET['p_id'])) {
                $id = $_GET['p_id'];
                $sql_count = "SELECT * FROM `posts` WHERE post_id = $id";
                $res_count = $conn->query($sql_count);
                $rows = $res_count->fetch_array();
                $likes = $rows['post_likes'];
            }

            ?>
            <div class="row">
                <p class="pull-right likes">Like: <?php echo $likes ?></p>
            </div>

            <div class="clearfix"></div>
            <hr>

            <!-- Blog Comments -->

            <?php

            if (isset($_POST['add'])) {
                $id = $_GET['p_id'];
                $post_id = $v['post_id'];
                $name = $_POST['comment_author'];
                $email = $_POST['comment_email'];
                $content = $_POST['content'];
                $date = date('Y-m-d');

                $name = mysqli_real_escape_string($conn, $name);
                $email = mysqli_real_escape_string($conn, $email);
                $content = mysqli_real_escape_string($conn, $content);

                if ($name == '' and $email == '' and  $content == '') {
                    $error_msg = 'Please Input all required fields!!';
                } else {
                    $sql_com = "INSERT INTO comments (`com_post_id`, `com_author`, `com_email`, `com_content`, `com_date`) VALUES ('$post_id','$name','$email','$content','$date')";
                    $result_com = $conn->query($sql_com);
                    $error_msg = null;
                    echo "<h2>Comments Sent For Approval!!</h2>";
                }
            }
            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <h3 style='color:red; text-align:center;'>
                    <?php echo $error_msg != null ?  $error_msg : '' ?>
                </h3>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="Author">Name *</label>
                        <input type="text" class="form-control" name="comment_author">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email *</label>
                        <input type="email" class="form-control" name="comment_email">
                    </div>
                    <div class="form-group">
                        <label for="Author">Your Comments *</label>
                        <textarea class="form-control" rows="3" name="content"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="add">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            <div class="well">
                <h3>Total Comments: <?php echo  $count_com ?></h3>
                <?php
                $id = $_GET['p_id'];
                $sql_com_view = "SELECT * FROM comments WHERE com_post_id = '$id' AND com_status = 'approved'";
                $res_com_view = $conn->query($sql_com_view);
                if ($res_com_view->num_rows > 0) {
                    while ($data = $res_com_view->fetch_array()) {
                        echo "<div class='media'>
                        <a class='pull-left' href='#'>
                            <img class='media-object' src='http://placehold.it/64x64' alt=''>
                        </a>
                        <div class='media-body'>
                            <h4 class='media-heading'>{$data['com_author']}
                                <small>{$data['com_date']}</small>
                            </h4>
                            {$data['com_content']}
                        </div>
                    </div>";
                    }
                }
                ?>
            </div>


        </div>

        <!-- Blog Sidebar Widgets Column -->
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

    <script>

    </script>