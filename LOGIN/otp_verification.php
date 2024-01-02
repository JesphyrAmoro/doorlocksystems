<?php
session_start();
include('../database.php');

<?php
session_start();
include('../database.php');

if (isset($_POST["verify_otp"])) {
    $user_otp = $_POST["otp"];
    $stored_otp = $_SESSION['otp'];

    if ($user_otp == $stored_otp) {
        ?>
        <script>
            alert("Change Password successful!");
            window.location.replace('index.php');
        </script>
        <?php
        
        exit();
    } else {
        // Incorrect OTP entered
        ?>
        <script>
            alert("<?php echo "Incorrect OTP. Please try again."; ?>");
        </script>
        <?php
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <title>OTP Verification</title>
    <style>
        body {
            background-color: #ffffff; /* White background */
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: 0;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #28a745; /* Green color */
            color: white;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #28a745; /* Green color */
            color: white;
            border: 0;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838; /* Darker shade of green on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">OTP Verification</h4>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST" name="verify_otp_form">
                            <div class="form-group">
                                <label for="otp">Enter OTP</label>
                                <input type="text" id="otp" class="form-control" name="otp" required autofocus>
                            </div>

                            <div class="text-center">
                                <input type="submit" value="Verify OTP" name="verify_otp" class="btn btn-success"> <!-- Green button -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
