<?php
include('includes/header.php');
?>

<?php
if (isset($_GET['edit'])) {
    $cat_id = $_GET['edit'];
    $sql_edit = "SELECT * FROM categories WHERE cat_id = '$cat_id'";
    $result_edit = $conn->query($sql_edit);
    $v = $result_edit->fetch_array();

}
if (isset($_POST['update_category'])) {
    $cat_id = $_POST['cat_id'];
    $cat_title = $_POST['cat_title'];
    $sql = "UPDATE `categories` SET `cat_title`='$cat_title' WHERE cat_id = '$cat_id'";
    $result = $conn->query($sql);
    //UPDATE `categories` SET `cat_id`='[value-1]',`cat_title`='[value-2]'
    header("Location: managecate.php");
}
?>
<div id="wrapper">

    <!-- Navigation -->

    <?php
    include('includes/navigation.php');
    ?>

    <div id="page-wrapper" style="height: 100%;">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Edit Category
                        <small>Subheading</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Edit Category
                        </li>
                    </ol>
                </div>
            </div>
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

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php
    include('includes/footer.php');
    ?>