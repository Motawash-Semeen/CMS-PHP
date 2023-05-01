<?php
include('includes/header.php');
?>



<?php
if (isset($_GET['do']) and $_GET['do']=='delete') {
    $cat_id = $_GET['id'];
    $sql_delete = "DELETE FROM categories WHERE cat_id = '$cat_id '";
    $conn->query($sql_delete);
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
                        Manage Category
                        <small>Subheading</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Manage Category
                        </li>
                    </ol>
                </div>
            </div>

            <?php

            if (isset($_GET['do'])) {
                $source = $_GET['do'];
            } else {
                $source = "";
            }
            switch ($source) {
                case 'new':
                    include "./includes/category/addcate.php";
                    break;
                case 'edit':
                    include "./includes/category/editcate.php";
                    break;
                case 'delete':

                    break;
                default:
                    include "./includes/category/showcate.php";
                    break;
            }
            ?>



        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php
include('includes/footer.php');
?>