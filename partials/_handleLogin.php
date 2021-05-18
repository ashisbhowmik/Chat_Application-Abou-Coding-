<?php

    $login = false;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        include '_dbconnect.php';
        $email = $_POST['name'];
        $password = $_POST['password'];
        // $sql = "SELECT * FROM `users` WHERE `users`.`user_email`='$email'";
        $sql  = "SELECT * FROM `users` WHERE `users`.`user_email`='$email' AND `users`.`user_pass`='$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_num_rows($result);
        if ($row == 1) {
               $row1 = mysqli_fetch_assoc($result);
               $login = true;
               session_start();
               $_SESSION['loggedin'] = true;
               $_SESSION['sno'] = $row1['sno'];
               $_SESSION['useremail'] = $email;
               echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success !</strong> You are now logged in!
                        <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"
                        ></button>
                    </div>';
                  header("location: /forum2/index.php");
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Alert!</strong> Invalid Credentials
                        <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"
                        ></button>
                    </div>';
        }
    }

?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Please Login Here</title>
</head>

<body>
    <?php require "_nav.php";  ?>


    <div class="container my-5">
        <h2 class="text-center">Please Login with the username and password</h2>
        <form action="/forum2/partials/_handleLogin.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">UserName</label>
                <input type="text" class="form-control" id="name" name="name" />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" />
            </div>
            <button type="submit" class="btn btn-primary">LogIn</button>
        </form>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>