<!-- PHP & MYSQL CODE FOR DELETE A ROW -->
<?php
include "../includes/db.php";
?>
<?php 
if(isset($_GET['source']) and $_GET['source']=='delete'){
    $id = $_GET['id'];
    $sql_del = "DELETE FROM posts WHERE post_id = '$id'";
    $conn->query($sql_del);
    header("Location: manageposts.php");
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
            //include "./includes/showpost.php";
            //include "./includes/addpost.php";
            //include "./includes/updatepost.php";

             if(isset($_GET['source'])){
                    $source = $_GET['source'];
                }
                else{
                    $source = ""; 
                }
                switch($source){
                    case 'new':
                        include "./includes/addpost.php";
                    break;
                    case 'edit':
                        include "./includes/updatepost.php";
                    break;
                    case 'delete':
                        
                    break;
                    default:
                    include "./includes/showpost.php";
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