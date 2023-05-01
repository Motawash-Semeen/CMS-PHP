<?php 
    include './includes/db.php';
    if(isset($_POST['submit'])){
    $cat_name = $_POST['cat_name'];

    $sql_insert = "INSERT INTO categories (cat_title) VALUES ('$cat_name')";

    $result_insert = $conn->query($sql_insert);

    header("Location: managecate.php");
}

?>


<!-- /.row -->
<div class="row ">
    <form action="" method="post" class="col-lg-4">
        <div class="form-row align-items-center ">
            <div class="col-auto col-lg-8 mb-2">
                <label class="sr-only" for="inlineFormInput">Category Name</label>
                <input type="text" class="form-control mb-2" name="cat_name" id="inlineFormInput" placeholder="Category Name">
            </div>
            <div class="col-auto">
                <button type="submit" name="submit" class="btn btn-primary mb-2">Submit</button>
            </div>
        </div>
    </form>
</div>