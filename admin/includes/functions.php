<?php 


 function insert_category(){
    include '../includes/db.php';
    if(isset($_POST['submit'])){
    $cat_name = $_POST['cat_name'];

    $sql_insert = "INSERT INTO categories (cat_title) VALUES ('$cat_name')";

    $result_insert = $conn->query($sql_insert);
}
}

?>