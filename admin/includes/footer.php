
    <!-- jQuery -->
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>

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
                $sql3 = "SELECT * FROM categories";
                $res3 = $conn->query($sql3);
                $count3 = mysqli_num_rows($res3);

                ?>['Categories', <?php echo  $count3?>, <?php echo  $count3?>, 0],
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
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

</body>

</html>