<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CMS PROJECT</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">About</a>
                </li>


                <?php 
                
                    $sql = "SELECT * FROM categories";
                    $result = $conn->query($sql);

                    if($result->num_rows>0){
                        $i=0;
                        while($row = $result->fetch_array()){
                            if($i<4){
                              echo "<li>
                           <a href='category.php?cat_id={$row['cat_id']}'>{$row['cat_title']}</a>
                       </li>";  
                            }
                            $i++;
                        }
                    }
                    else{
                        echo '';
                    }
                ?>


                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="admin/index.php">Admin</a>
                </li>
                <?php 
                    if(isset($_SESSION['id']) and isset($_GET['p_id'])){
                        $p_id = $_GET['p_id'];
                        $role = $_SESSION['role'];
                        if($role!='user'){
                           echo "<li>
                        <a href='admin/manageposts.php?id={$p_id}&source=edit'>Edit This Post</a>
                    </li>"; 
                        }
                        
                    }
                ?>
                <li>
                    <a href="#">Contact</a>
                </li>
                <?php 
                    if(isset($_SESSION['id'])){
                           echo "<li>
                        <a href='includes/logout.php'>LogOut</a>
                    </li>"; 
                    }
                ?>
                <?php 
                    if(!isset($_SESSION['id'])){
                           echo "<li>
                        <a href='registration.php'>Registration</a>
                    </li>"; 
                    }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
