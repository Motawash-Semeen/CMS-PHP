<!-- PHP AND MYSQL CODE FOR SHOWING DATA FOR A SPECIFIC ROW-->

<?php
if (isset($_GET['source']) and $_GET['source']=='edit') {
    $post_id = $_GET['id'];
    $sql_edit = "SELECT * FROM posts WHERE post_id = '$post_id'";
    $result_edit = $conn->query($sql_edit);
    $v = $result_edit->fetch_array();
}
?>

<!-- PHP AND MYSQL CODE FOR UPDATING DATA -->

<?php
if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $title = $_POST['title'];
    $name = $_POST['author_name'];
    $date = $_POST['date'];
    $category = $_POST['category'];
    $tags = $_POST['tags'];
    if (isset($_FILES['image'])) {
        $img_name = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exc = array("jpg", "jpeg", "png");

        if (in_array($img_ex_lc, $allowed_exc)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = './images/' . $new_img_name;
            move_uploaded_file($temp_name, $img_upload_path);
        } else {
            $em = "Only JPG, JPEG, PNG acceptable";
            //header("Location: manageposts.php");
        }
        if ($img_name == '') {
            $new_img_name = $_POST['old_image'];
        }
    }


    $status = $_POST['status'];
    $content = $_POST['content'];

    $title = mysqli_real_escape_string($conn, $title);
    $name = mysqli_real_escape_string($conn, $name);
    $date = mysqli_real_escape_string($conn, $date);
    $category = mysqli_real_escape_string($conn, $category);
    $tags = mysqli_real_escape_string($conn, $tags);
    $status = mysqli_real_escape_string($conn, $status);
    $content = mysqli_real_escape_string($conn, $content);

    if ($title == '' or $name == '' or $date == '' or $category == '' or $content == '') {
        echo "<p>Please Enter Required Data!</p>";
        header("Location:  manageposts.php");
    } else {


        $sql_up = "UPDATE `posts` SET `post_cat_id`='$category',`post_title`='$title',`post_author`='$name',`post_date`='$date',`post_img`='$new_img_name',`post_content`='$content',`post_tags`='$tags',`post_status`='$status' WHERE `post_id` = '$id'";

        $re_up = $conn->query($sql_up);
        header("Location:  manageposts.php");
    }
}
?>


<div class="row ">
    <h2 style="text-align:center;">Update Post</h2>
    <form action="" method="post" class="col-lg-6 col-lg-offset-3" enctype="multipart/form-data">
        <div class="form-row align-items-center ">
            <input type="hidden" class="form-control mb-2" name="id" value="<?php echo $v['post_id'] ?>">
            <div class=" col-lg-12 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Post Title</label>
                <input type="text" class="form-control mb-2" name="title" placeholder="Post Title" value="<?php echo $v['post_title'] ?>">
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Author Name</label>
                <input type="text" class="form-control mb-2" name="author_name" placeholder="Author Name" value="<?php echo $v['post_author'] ?>">
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Date</label>
                <input type="date" class="form-control mb-2" name="date" placeholder="" value="<?php echo $v['post_date'] ?>">
            </div>
            <div class=" col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
                <label for="cars">Category:</label>

                <select name="category" style="padding: 6px 12px;">
                    <option value="">...Select Category...</option>
                    <?php
                    $sql_cate = "SELECT * FROM categories";
                    $result_cate = $conn->query($sql_cate);
                    if ($result_cate->num_rows > 0) {
                        while ($row = $result_cate->fetch_array()) {
                            $select = $v['post_cat_id'] == $row['cat_id'] ? 'selected' : '';
                            echo "<option value='{$row['cat_id']}' {$select}>
                            {$row['cat_title']}
                            </option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
                <label for="inlineFormInput">Post Tags</label>
                <input type="text" class="form-control mb-2" name="tags" placeholder="" value="<?php echo $v['post_tags'] ?>">
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <img src='images/<?php echo $v['post_img'] ?>' width='250'>
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Post Image</label>
                <input type="file" class="form-control mb-2" name="image">
                <input type="hidden" class="form-control mb-2" name="old_image" value="<?php echo $v['post_img'] ?>">
            </div>
            <div class=" col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
                <label for="inlineFormInput">Post Status</label>
                <select name="status" style="padding: 6px 12px;">
                    <option value="">...Select Status...</option>
                    <option value="active" <?php echo $v['post_status'] == 'active' ? 'selected ' : '' ?>>Active</option>
                    <option value="draft" <?php echo $v['post_status'] == 'draft' ? 'selected ' : '' ?>>Draft</option>
                </select>
            </div>


            <div class=" col-lg-12 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
                <label for="w3review">Post Content:</label>
                <textarea id="w3review" name="content" rows="4"><?php echo $v['post_content'] ?></textarea>
            </div>
            <div class="col-lg-2 col-lg-offset-5">
                <button type="submit" name="update" class="btn btn-primary mb-2">Submit</button>
            </div>
        </div>
    </form>
</div>