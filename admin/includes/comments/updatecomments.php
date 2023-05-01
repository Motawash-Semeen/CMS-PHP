<!-- PHP AND MYSQL CODE FOR SHOWING DATA FOR A SPECIFIC ROW-->

<?php
if (isset($_GET['do']) and $_GET['do']=='edit') {
    $com_id = $_GET['id'];
    $sql_edit = "SELECT * FROM comments WHERE com_id = '$com_id'";
    $result_edit = $conn->query($sql_edit);
    $v = $result_edit->fetch_array();
}
?>

<!-- PHP AND MYSQL CODE FOR UPDATING DATA -->

<?php
if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $name = $_POST['author_name'];
    $email = $_POST['author_email'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $title = mysqli_real_escape_string($conn, $title);
    $name = mysqli_real_escape_string($conn, $name);
    $date = mysqli_real_escape_string($conn, $date);
    $status = mysqli_real_escape_string($conn, $status);
    $content = mysqli_real_escape_string($conn, $content);

    if ($title == '' or $name == '' or $date == '' or $content == '') {
        echo "<p>Please Enter Required Data!</p>";
        header("Location:  managecomments.php");
    } else {


        $sql_up = "UPDATE `comments` SET `com_post_id`='$title',`com_author`='$name',`com_email`='$email',`com_content`='$content',`com_status`='$status',`com_date`='$date' WHERE `com_id` = '$id'";

        $re_up = $conn->query($sql_up);
        header("Location:  managecomments.php");
    }
}
?>


<div class="row ">
    <h2 style="text-align:center;">Update Comments</h2>
    <form action="" method="post" class="col-lg-6 col-lg-offset-3" enctype="multipart/form-data">
        <div class="form-row align-items-center ">
            <input type="hidden" class="form-control mb-2" name="id" value="<?php echo $v['com_id'] ?>">
            
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Author Name</label>
                <input type="text" class="form-control mb-2" name="author_name" placeholder="Author Name" value="<?php echo $v['com_author'] ?>">
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Author Email</label>
                <input type="email" class="form-control mb-2" name="author_email" placeholder="Author Email" value="<?php echo $v['com_email'] ?>">
            </div>
            <div class=" col-lg-6 mb-2" style=" margin-bottom:30px">
                <label for="inlineFormInput">Date</label>
                <input type="date" class="form-control mb-2" name="date" placeholder="" value="<?php echo $v['com_date'] ?>">
            </div>
            <div class=" col-lg-6 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
                <label for="inlineFormInput">Post Status</label>
                <select name="status" style="padding: 6px 12px;">
                    <option value="">...Select Status...</option>
                    <option value="approved" <?php echo $v['com_status'] == 'approved' ? 'selected ' : '' ?>>Approved</option>
                    <option value="disapproved" <?php echo $v['com_status'] == 'disapproved' ? 'selected ' : '' ?>>Disapproved</option>
                </select>
            </div>
            <div class=" col-lg-12 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
                <label for="cars">Post Title:</label>

                <select name="title" style="padding: 6px 12px;">
                    <option value="">...Select Post Title...</option>
                    <?php
                    $sql_cate = "SELECT * FROM posts";
                    $result_cate = $conn->query($sql_cate);
                    if ($result_cate->num_rows > 0) {
                        while ($row = $result_cate->fetch_array()) {
                            $select = $v['com_post_id'] == $row['post_id'] ? 'selected' : '';
                            echo "<option value='{$row['post_id']}' {$select}>
                            {$row['post_title']}
                            </option>";
                        }
                    }
                    ?>
                </select>
            </div>




            <div class=" col-lg-12 mb-2" style="display:flex; flex-direction:column; margin-bottom:30px">
                <label for="w3review">Comment Content:</label>
                <textarea id="w3review" name="content" rows="4"><?php echo $v['com_content'] ?></textarea>
            </div>
            <div class="col-lg-2 col-lg-offset-5">
                <button type="submit" name="update" class="btn btn-primary mb-2">Submit</button>
            </div>
        </div>
    </form>
</div>