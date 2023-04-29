<?php
include('includes/header.php');
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
                        Manage Posts
                        <small>Subheading</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Manage Posts
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <?php 
                //include "./includes/showpost.php";
            ?>
             <div class="row ">

            <form action="" method="post" class="col-lg-6 col-lg-offset-3">
                <div class="form-row align-items-center ">
                    <div class="col-auto col-lg-12 mb-2">
                        <label  for="inlineFormInput">Post Title</label>
                        <input type="text" class="form-control mb-2" name="cat_name" id="inlineFormInput" placeholder="Post Title">
                    </div>
                    <div class="col-auto col-lg-6 mb-2">
                        <label  for="inlineFormInput">Author Name</label>
                        <input type="text" class="form-control mb-2" name="cat_name" id="inlineFormInput" placeholder="Author Name">
                    </div>
                    <div class="col-auto col-lg-6 mb-2">
                        <label  for="inlineFormInput">Post Title</label>
                        <input type="text" class="form-control mb-2" name="cat_name" id="inlineFormInput" placeholder="Post Title">
                    </div>
                    <div class="col-lg-4">
                        <button type="submit" name="submit" class="btn btn-primary mb-2">Submit</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php
    include('includes/footer.php');
    ?>