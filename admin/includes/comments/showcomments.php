<?php
if (isset($_GET['status'])) {
    $id = $_GET['id'];
    if ($_GET['status'] == 'approved') {
        $satus = 'disapproved';
    } else {
        $satus = 'approved';
    }
    $sql_status = "UPDATE comments SET com_status = '$satus' WHERE com_id = '$id'";
    $result_status = $conn->query($sql_status);
    header("Location: managecomments.php");
}

?>
<div class="row">
    <div class="col-md-12">
        <!-- <div style="text-align:right; margin:auto;">
            <a href='manageposts.php?source=new' class='btn btn-link btn-warning btn-just-icon edit' style="padding: 6px 12px; background-color:deepskyblue; border-radius: 5px; color:white; margin-bottom: 20px;">
                Add New Comments
            </a>
        </div> -->

        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Comment</th>
                    <th>In Response to</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <!-- PHP & MYSQL CODE FOR SHOWING ALL DATA -->

                <?php
                $sql_com = "SELECT * FROM comments";
                $result_com = $conn->query($sql_com);
                if ($result_com->num_rows > 0) {
                    $i = 1;
                    while ($row = $result_com->fetch_array()) {
                        $post_id = $row['com_post_id'];
                        $sql_post = "SELECT * FROM posts WHERE post_id = '$post_id'";
                        $result_post = $conn->query($sql_post);
                        $post_title = $result_post->fetch_array();

                        echo "<tr>
                                                <td>{$i}</td>
                                                <td>{$row['com_author']}</td>
                                                <td>{$row['com_email']}</td>
                                                <td>{$row['com_content']}</td>
                                                <td><a href='../post.php?id={$post_id}'>{$post_title['post_title']}</a>
                                                </td>
                                                <td>{$row['com_date']}</td>
                                                <td>
                                                <a href='managecomments.php?id={$row['com_id']}&status={$row['com_status']}' class='btn btn-info'>
                                                {$row['com_status']}
                                                    </a>
                                                </td>
                                                
                                                <td class='text-right'>
                                                <a href='managecomments.php?id={$row['com_id']}&do=edit' class='btn btn-warning' style='margin-bottom:5px;'>
                                                                    EDIT
                                                    </a>
                                                    <a href='managecomments.php?id={$row['com_id']}&do=delete' class='btn btn-danger'>
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

    </div>
</div>


<!-- /.container-fluid -->