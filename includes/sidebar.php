
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input type="text" name="data" class="form-control">
                <span class="input-group-btn">
                    <button name="search" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- LOGIN Well -->
    <div class="well">
        <h4>LogIn</h4>
<?php 

if(isset($_SESSION['msg'])){
    $msg = $_SESSION['msg'];
    echo "<h4 style='color:red;'>{$msg}</h4>";
}
?>
        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <input type="submit" name="login" class="form-control btn btn-info" value="LogIn">
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <?php
            $sql_cate = "SELECT * FROM categories";
            $result_cate = $conn->query($sql_cate);

if ($result_cate->num_rows > 0) {
    $i = 0;
    ?>
                <div class="col-lg-6">
            <ul class="list-unstyled">
                <?php
    while ($row = $result_cate->fetch_array()) {


        if ($i < 4) {
            echo "<li><a href='category.php?id={$row['cat_id']}'>{$row['cat_title']}</a>";
        }

        $i++;
    }
}
                ?>
                </ul>
        </div>

        <?php
            $sql_cate = "SELECT * FROM categories";
            $result_cate = $conn->query($sql_cate);

if ($result_cate->num_rows > 0) {
    $i = 0;
    ?>
                <div class="col-lg-6">
            <ul class="list-unstyled">
                <?php
    while ($row = $result_cate->fetch_array()) {


        if ($i > 3 and $i < 8) {
            echo "<li><a href='category.php?id={$row['cat_id']}'>{$row['cat_title']}</a>";
        }

        $i++;
    }
}
                ?>
                </ul>
        </div>

            <!-- <div class="col-lg-6">
            <ul class="list-unstyled">
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-6">
            <ul class="list-unstyled">
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
            </ul>
        </div> -->
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>