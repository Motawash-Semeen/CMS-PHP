<?php include "db.php"; ?>
<?php
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql_auth = "SELECT * FROM users WHERE user_email='$email' AND user_password='$password'";
    $result_auth = $conn->query($sql_auth);
    if ($result_auth->num_rows > 0) {
        $v = $result_auth->fetch_array();
        if ($v['user_status'] == 'approved') {
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $v['user_id'];
            $_SESSION['username'] = $v['username'];
            $_SESSION['role'] = $v['role'];
            $_SESSION['msg'] = null;
            header("Location: ./admin/index.php");
        } else {
            $_SESSION['msg'] = 'Pending For Approval!!';
            header("Location: ./index.php");
        }
    } else {
        $_SESSION['msg'] = 'Not Correct Password or Email!';
        header("Location: ./index.php");
    }
}
?>
<div class="well">
    <h4>LogIn</h4>
    <?php
    if (isset($_SESSION['msg'])) {
        $msg = $_SESSION['msg'];
        echo "<h4 style='color:red;'>{$msg}</h4>";
    }
    ?>
    <form action="index.php" method="post">
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