<!-- PHP & MYSQL CODE FOR DELETE A ROW -->
<?php
include "../includes/db.php";
?>
<?php 
if(isset($_GET['do']) and $_GET['do']=='delete'){
    $id = $_GET['id'];

    $sql_del = "DELETE FROM comments WHERE com_id = '$id'";
    $result_del = $conn->query($sql_del);
    header("Location: managecomments.php");
}
?>


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

             if(isset($_GET['do'])){
                    $source = $_GET['do'];
                }
                else{
                    $source = ""; 
                }
                switch($source){

                    case 'edit':
                        include "./includes/comments/updatecomments.php";
                    break;
                    case 'delete':
                        
                    break;
                    default:
                    include "./includes/comments/showcomments.php";
                    break;
                }
            ?>

            


        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php
    include('includes/footer.php');
    ?>