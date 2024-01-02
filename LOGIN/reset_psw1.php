<?php session_start() ;
include('../database.php');
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <title>Login Form</title>
    <style>
           html {
      font-family: Arial;
      display: inline-block;
      margin: 0px auto;
      text-align: center;
    }

    ul.topnav {
      list-style-type: none;
      margin: auto;
      padding: 0;
      overflow: hidden;
      background-color: #4CAF50;
      width: 100%;
    }

    ul.topnav li {float: left;}

    ul.topnav li a {
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    ul.topnav li a:hover:not(.active) {background-color: #3e8e41;}

    ul.topnav li a.active {background-color: #333;}

    ul.topnav li.right {float: right;}
     </style>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">

    <div class="container">
        <a class="navbar-brand" href="#">Password Reset Form</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Reset Your Password</div>
                    <div class="card-body">
                        <form action="#" method="POST" name="reset_password">

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password" required autofocus>
                                    <br>
                                </div>
                                <label for="confirmpassword" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="confirmpassword" class="form-control" name="confirmpassword" required autofocus>
                                    <br>
                                    <i class="bi bi-eye-slash" id="togglePassword">Show password</i>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Reset" name="reset">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>

<?php

// Assuming you have set $_SESSION['email'] during the login process
$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;

if (isset($_POST["reset"])) {
    $psw = $_POST["password"];
    $confirm_psw = $_POST["confirmpassword"];

    if ($psw !== $confirm_psw) {
        ?>
        <script>
            alert("<?php echo "Passwords do not match. Please try again."; ?>");
        </script>
        <?php
        exit(); // Stop further execution if passwords don't match
    }

    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;

    require "../Mail/phpmailer/PHPMailerAutoload.php";
    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    $mail->Username = 'developer.doorlock@gmail.com';
    $mail->Password = 'olftvsjikbqhjkod';

    $mail->setFrom('developer.doorlock@gmail.com', 'OTP Verification');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "Your password reset OTP code";
    $mail->Body = "<p>Dear user, </p> <h3>Your password reset OTP code is $otp <br></h3>";

    if (!$mail->send()) {
        ?>
        <script>
            alert("<?php echo "Failed to send OTP. Please try again."; ?>");
        </script>
        <?php
    } else {
        // Password update logic
        $hash = password_hash($psw, PASSWORD_DEFAULT);

        // Assuming you have a column named 'password' in your 'login' table
        mysqli_query($conn, "UPDATE login SET password='$hash' WHERE email='$email'");

        ?>
        <script>
            window.location.replace("otp_verification.php");
            alert("<?php echo "OTP sent to " . $email; ?>");
        </script>
        <?php
    }
}
?>



<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const confirmpassword = document.getElementById('confirmpassword');

    toggle.addEventListener('click', function () {
        if (password.type === "password") {
            password.type = 'text';
        } else {
            password.type = 'password';
            confirmpassword.type = 'password';
        }
        this.classList.toggle('bi-eye');
    });
</script>
