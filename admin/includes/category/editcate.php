<?php
if (isset($_GET['do']) and $_GET['do']=='edit') {
    $cat_id = $_GET['id'];
    $sql_edit = "SELECT * FROM categories WHERE cat_id = '$cat_id'";
    $result_edit = $conn->query($sql_edit);
    $v = $result_edit->fetch_array();
}
if (isset($_POST['update_category'])) {
    $cat_id = $_POST['cat_id'];
    $cat_title = $_POST['cat_title'];
    $sql = "UPDATE `categories` SET `cat_title`='$cat_title' WHERE cat_id = '$cat_id'";
    $result = $conn->query($sql);
    header("Location: managecate.php");
}
?>


<!-- /.row -->
<div class="row">
    <div class="col-md-4 col-lg-offset-4">
        <form action="" method="post">
            <div class="form-group">
                <input value=<?php echo $v['cat_id'] ?> type="hidden" class="form-control" name="cat_id">
                <label for="cat-title">Edit Category</label>
                <input value=<?php echo $v['cat_title'] ?> type="text" class="form-control" name="cat_title">

            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
            </div>

        </form>

    </div>
</div>
<!-- /.container-fluid -->