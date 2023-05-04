<?php
if (isset($_GET['status'])) {
    $id = $_GET['id'];
    if ($_GET['status'] == 'approved') {
        $satus = 'disapproved';
    } else {
        $satus = 'approved';
    }
    $sql_status = "UPDATE users SET user_status = '$satus' WHERE user_id = '$id'";
    $result_status = $conn->query($sql_status);
    header("Location: manageuser.php");
}
?>
<div class="row">
    <div class="col-md-12">
        <div style="text-align:right; margin:auto;">
            <a href='manageuser.php?source=new' class='btn btn-link btn-warning btn-just-icon edit' style="padding: 6px 12px; background-color:deepskyblue; border-radius: 5px; color:white; margin-bottom: 20px;">
                Add New User
            </a>
        </div>

        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>User Image</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <!-- PHP & MYSQL CODE FOR SHOWING ALL DATA -->

                <?php
                $sql_user = "SELECT * FROM users";
                $result_user = $conn->query($sql_user);
                if ($result_user->num_rows > 0) {
                    $i = 1;
                    while ($row = $result_user->fetch_array()) {
                        $img = $row['user_img'];
                        $img_link = $img==null? 'https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg': './images/'.$img;
                        echo "<tr>
                                <td>{$i}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['user_email']}</td>
                                <td>{$row['user_fname']}</td>
                                <td>{$row['user_lname']}</td>
                                <td>
                                
                                <img src='{$img_link}' class='avatar img-circle img-thumbnail' alt='avatar' width='150'>
                                
                                
                                </td>
                                <td>{$row['role']}</td>
                                <td>
                                <a href='manageuser.php?id={$row['user_id']}&status={$row['user_status']}' class='btn btn-info'>
                                {$row['user_status']}
                                    </a>
                                </td>
                                <td class='text-right'>
                                    <a href='manageuser.php?id={$row['user_id']}&source=edit' class='btn btn-warning'>
                                                    EDIT
                                    </a>
                                    <a onClick=\"javascript: return confirm('Are you sure you want to delete this Item?'); \" href='manageuser.php?id={$row['user_id']}&source=delete' class='btn btn-danger '>
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
<!-- 
<img src='https://st3.depositphotos.com/6672868/13701/v/450/depositphotos_137014128-stock-illustration-user-profile-icon.jpg' class='avatar img-circle img-thumbnail' alt='avatar' width='150'>
                                <img src='./images/{$row['user_img']}' width='100'> -->