<?php
include('includes/header.php');
include('includes/functions.php');
?>

<?php 
insert_category();
?>

<div id="wrapper">

    <!-- Navigation -->

    <?php
    include('includes/navigation.php');
    ?>

    <div id="page-wrapper" style="height: 90vh;">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Add Category
                        <small>Subheading</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Add Category
                        </li>
                    </ol>
                </div>
            </div>
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
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php
include('includes/footer.php');
?>