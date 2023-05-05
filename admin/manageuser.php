<?php
include "../includes/db.php";
?>

<?php
include('includes/header.php');
?>
<?php

if (isset($_GET['source']) and $_GET['source'] == 'delete') {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            $id = $_GET['id'];
            $sql_del = "DELETE FROM users WHERE user_id = '$id'";
            $conn->query($sql_del);
            header("Location: manageuser.php");
        }
    }
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
                        Manage Users
                        <small>Subheading</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Manage User
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <?php


            if (isset($_GET['source'])) {
                $source = $_GET['source'];
            } else {
                $source = "";
            }
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 'admin') {
                    switch ($source) {
                        case 'new':
                            include "./includes/users/adduser.php";
                            break;
                        case 'edit':
                            include "./includes/users/updateuser.php";
                            break;
                        case 'delete':

                            break;
                        default:
                            include "./includes/users/showuser.php";
                            break;
                    }
                }
            }


            ?>




        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php
    include('includes/footer.php');
    ?>