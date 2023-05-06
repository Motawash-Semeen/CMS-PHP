<?php
if (isset($_GET['status'])) {
    $id = $_GET['id'];
    if ($_GET['status'] == 'active') {
        $satus = 'draft';
    } else {
        $satus = 'active';
    }
    $sql_status = "UPDATE posts SET post_status = '$satus' WHERE post_id = '$id'";
    $result_status = $conn->query($sql_status);
    header("Location: manageposts.php");
}

?>
<?php
if (isset($_GET['reset'])) {
    $id = $_GET['reset'];
    $sql_views = "UPDATE posts SET post_views = 0 WHERE post_id = '$id'";
    $conn->query($sql_views);
    header("Location: manageposts.php");
}

?>
<?php
  if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $checkBoxValue){
        $bulk_options = $_POST['bulk_options'];


        switch($bulk_options){
            case 'delete':
                $sql = "DELETE FROM posts WHERE post_id = '{$checkBoxValue}'";
                $conn->query($sql);
                break;
            case 'active':
                $sql = "UPDATE posts SET post_status='{$bulk_options}' WHERE post_id = '{$checkBoxValue}'";
                $conn->query($sql);
                break;
            case 'draft':
                $sql = "UPDATE posts SET post_status='{$bulk_options}' WHERE post_id = '{$checkBoxValue}'";
                $conn->query($sql);
                break;
            case 'clone':
                $sql = "SELECT * FROM posts WHERE post_id = '{$checkBoxValue}'";
                $res = $conn->query($sql);
                $v = $res->fetch_array();
                $post_cat_id = $v['post_cat_id'];
                $post_title = $v['post_title'];
                $post_author = $v['post_author'];
                $post_date = $v['post_date'];
                $post_img = $v['post_img'];
                $post_content = $v['post_content'];
                $post_tags = $v['post_tags'];
                $post_status = $v['post_status'];

                $sql_new = "INSERT INTO posts (post_cat_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_status) VALUES ('$post_cat_id','$post_title','$post_author','$post_date','$post_img','$post_content','$post_tags','$post_status')";
                $conn->query($sql_new);
                break;

        }
    }
  }
?>

<?php 



?>
<div class="row">

    <div class="col-md-12 ">
        <form action='' method='post'>
            <div style='display:flex; justify-content:space-between;  align-items:center; margin-bottom:20px;'>

                <div id='bulkoption' style='display:flex; gap:10px;'>
                    <select name='bulk_options' class='form-control' id='' style='padding: 6px 12px;'>
                        <option value=''>..Select Options...</option>
                        <option value='delete'>Delete</option>
                        <option value='active'>Active</option>
                        <option value='draft'>Draft</option>
                        <option value='clone'>Clone</option>
                    </select>

                    <input type='submit' name='submit' class="btn btn-success" value='Apply'>
                </div>

                <div>
                    <a href='manageposts.php?source=new' class='btn btn-link btn-warning btn-just-icon edit'
                        style="padding: 6px 12px; background-color:deepskyblue; border-radius: 5px; color:white; ">
                        Add New Post
                    </a>
                </div>
            </div>

            <table class="table table-bordered ">

                <thead>
                    <tr>
                        <th><input type="checkbox" id='selectAllBoxes'></th>
                        <th>SN</th>
                        <th>Author</th>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Content</th>
                        <th>Tags</th>
                        <th>Comments</th>
                        <th>Views</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- PHP & MYSQL CODE FOR SHOWING ALL DATA -->

                    <?php
                    $sql_post = "SELECT * FROM posts ORDER BY post_id DESC";
                    $result_post = $conn->query($sql_post);
                    if ($result_post->num_rows > 0) {
                        $i = 1;
                        while ($row = $result_post->fetch_array()) {
                            $cat_id = $row['post_cat_id'];
                            $sql_cat = "SELECT * FROM categories WHERE cat_id = $cat_id";
                            $result_cat = $conn->query($sql_cat);
                            $cat_title = $result_cat->fetch_array();

                            $sql_com = "SELECT * FROM comments WHERE com_post_id = $row[post_id]";
                            $result_com = $conn->query($sql_com);
                            $count_com = mysqli_num_rows($result_com);

                            echo "<tr>
                                                
                                                <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='{$row['post_id']}'></td>
                                                <td>{$i}</td>
                                                <td>{$row['post_author']}</td>
                                                <td>{$row['post_date']}</td>
                                                <td>
                                                <a href='../post.php?p_id={$row['post_id']}'>{$row['post_title']}</a>
                                                </td>
                                                <td>{$cat_title['cat_title']}</td>
                                                <td>
                                                <a href='manageposts.php?id={$row['post_id']}&status={$row['post_status']}' class='btn btn-info'>
                                                {$row['post_status']}
                                                    </a>
                                                </td>
                                                <td>
                                                <img src='./images/{$row['post_img']}' width='130'>
                                                </td>
                                                <td width='530'>{$row['post_content']}</td>
                                                <td>{$row['post_tags']}</td>
                                                <td>{$count_com}</td>
                                                <td><a href='manageposts.php?reset={$row['post_id']}'>{$row['post_views']}</a>
                                                </td>
                                                <td class='text-right'>
                                                    <a href='manageposts.php?id={$row['post_id']}&source=edit' class='btn btn-link btn-warning btn-just-icon edit'>
                                                                    EDIT
                                                    </a>
                                                    <a onClick=\"javascript: return confirm('Are you sure you want to delete this Item?'); \" href='manageposts.php?id={$row['post_id']}&source=delete' class='btn btn-link btn-danger btn-just-icon remove'>
                                                                    DELETE
                                                    </a>
                                                </td>
                                            </tr>";
                            $i++;
                        }
                    } else {
                        echo "<tr>
                                <td colspan='11' style='text-align: center'>No Data Found</td>
                                </tr>";
                    }
                    ?>

                </tbody>
            </table>
        </form>
    </div>
</div>


<!-- /.container-fluid -->