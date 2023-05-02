<?php include "db.php"; ?>

<?php 
session_start();
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql_auth = "SELECT * FROM users WHERE user_email='$email' AND user_password='$password'";
    $result_auth = $conn->query($sql_auth);
    if($result_auth->num_rows>0){
        $v=$result_auth->fetch_array();
        $_SESSION['email'] = $email;
        $_SESSION['id'] = $v['user_id'];
        $_SESSION['username'] = $v['username'];
        $_SESSION['role'] = $v['role'];
        $_SESSION['msg'] = null;
        header("Location: ../admin/index.php");
    }
    else{
        $_SESSION['msg'] = 'Not Correct Password or Email!';
        header("Location: ../index.php");
    }
}
?>