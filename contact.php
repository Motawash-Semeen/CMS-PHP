<?php
include('./includes/db.php');
?>
<?php
include('./includes/header.php');
?>
<!-- Navigation -->
<?php
include('./includes/navigation.php');
?>


<?php 
if(isset($_POST['submit'])){
    $to="noharahman0@gmail.com";
    $form= $_POST['email'];
    $subj = wordwrap($_POST['subject'], 70);
    $body = $_POST['body'];
    $headers = "From: ".$form;

    mail($to, $subj, $body, $headers);

    // $sql = "INSERT INTO `users`(`username`, `user_password`, `user_fname`, `user_lname`, `user_email`) VALUES ('$username','$password','$fname','$lname','$email')";
    // $conn->query($sql);

    echo"<h3 style='text-align:center; color:red'>Your Message is sent for Approval!!</h3>";
}
?>

<!-- Page Content -->

<div class="container">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <div class="form-wrap">
                <h1 style='text-align:center'>Contact Us</h1>
                <form role="form" action="" method="post">
                    <div class="form-group">
                        <label for="email" class="sr-only">Email *</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                    </div>
                    <div class="form-group">
                        <label for="subject" class="sr-only">Subject *</label>
                        <input type="text" name="subject" class="form-control" placeholder="Subjects">
                    </div>
                    <div class="form-group">
                        <label for="body" class="sr-only">Comments</label>
                        <textarea name="body" class="form-control" id="body" rows="10"></textarea>
                    </div>

                    <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                </form>

            </div>
        </div> <!-- /.col-xs-12 -->
    </div> <!-- /.row -->
<hr>
<?php
include('./includes/footer.php');
?>

</div> <!-- /.container -->






