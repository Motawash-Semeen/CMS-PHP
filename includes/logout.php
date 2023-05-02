<?php include "db.php"; ?>

<?php 
session_start();

$_SESSION['email'] = null;
$_SESSION['id'] = null;
$_SESSION['username'] = null;

header("Location: ../index.php");
?>