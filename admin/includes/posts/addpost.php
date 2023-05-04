<!-- PHP AND MYSQL CODE FOR ADD NEW POST  -->

<?php
if (isset($_POST['insert'])) {
    $title = $_POST['title'];
    $name = $_POST['author_name'];
    $date = $_POST['date'];
    $category = $_POST['category'];
    $tags = $_POST['tags'];
    //$image = $_POST['image'];
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
            header("Location: manageposts.php");
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
        $sql_in = "INSERT INTO posts (post_cat_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_status) VALUES ('$category','$title','$name','$date','$new_img_name','$content','$tags','$status')";

        $re_in = $conn->query($sql_in);
        header("Location:  manageposts.php");
    }
}
?>
<div class="row ">
    <h2 style="text-align:center;">Add Post</h2>
    <form action="" method="post" class="col-lg-6 col-lg-offset-3" enctype="multipart/form-data">
        <div class="form-row align-items-center ">
            <div class=" col-lg-12 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Post Title</label>
                <input type="text" class="form-control mb-2" name="title" placeholder="Post Title">
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Author Name</label>
                <input type="text" class="form-control mb-2" name="author_name" placeholder="Author Name" value="<?php  echo $_SESSION['username'] ?>" readonly>
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Date</label>
                <input type="date" class="form-control mb-2" name="date" value="<?php echo date('Y-m-d') ?>">
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
                            echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
                <label for="inlineFormInput">Post Tags</label>
                <input type="text" class="form-control mb-2" name="tags" placeholder="">
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Post Image</label>
                <input type="file" class="form-control mb-2" name="image">
            </div>
            <div class=" col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
                <label for="inlineFormInput">Post Status</label>
                <select name="status" style="padding: 6px 12px;">
                    <option value="">...Select Status...</option>
                    <option value="active">Active</option>
                    <option value="draft">Draft</option>
                </select>
            </div>


            <div class=" col-lg-12 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
                <label for="w3review">Post Content:</label>
                <textarea id="editor" name="content" rows="4"></textarea>
            </div>
            <div class="col-lg-2 col-lg-offset-5">
                <button type="submit" name="insert" class="btn btn-primary mb-2">Submit</button>
            </div>
        </div>
    </form>
</div>