<?php
include('../includes/db.php');
session_start();
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

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Item', 'Total', 'Active', 'Not Active'],

                <?php
                $array = ['posts', 'comments', 'users'];
                $array2 = ['post_status', 'com_status', 'user_status'];
                $count = [];
                $count2 = [];

                for ($i = 0; $i < 3; $i++) {
                    $sql = "SELECT * FROM {$array[$i]}";
                    $res = $conn->query($sql);
                    $count[$i] = mysqli_num_rows($res);

                    $sql2 = "SELECT * FROM {$array[$i]} WHERE {$array2[$i]} = 'approved' or {$array2[$i]} = 'active'";
                    $res2 = $conn->query($sql2);
                    $count2[$i] = mysqli_num_rows($res2);
                    $draft = $count[$i] - $count2[$i];
                    echo "['{$array[$i]}',{$count[$i]}, {$count2[$i]}, {$draft}],";
                }


                ?>['Categories', 7, 0, 0],
            ]);

            var options = {
                chart: {
                    title: 'Website Statistic',
                    subtitle: 'Post, Comments, Users and Categories',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
</head>

<body style="position: relative;">