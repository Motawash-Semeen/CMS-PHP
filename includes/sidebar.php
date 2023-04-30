<?php

?>

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