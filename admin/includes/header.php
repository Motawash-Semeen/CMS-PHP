<?php
session_start();
include('../includes/db.php');

?>
<?php
ob_start();
?>

<?php
$email = $_SESSION['email'];
$id = $_SESSION['id'];
$role = $_SESSION['role'];
if (($email && $id) == null) {
    header("Location: ../index.php");
} else {
    if ($role == 'user') {
        header("Location: ../index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- <link href="css/loader.css" rel="stylesheet"> -->

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    
</head>

<body style="position: relative;">