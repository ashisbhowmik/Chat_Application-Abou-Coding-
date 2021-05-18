<?php

$showError = "false";
$login = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include '_dbconnect.php';
    $email = $_POST['name'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `users` WHERE `users`.`user_email`='$email'";
    $result = mysqli_query($conn, $sql);
    $numRow = mysqli_num_rows($result);
    if ($numRow == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['user_pass'])) {
           $login = true;
           session_start();
           $_SESSION['loggedin'] = true;
           $_SESSION['useremail'] = $email;
           echo "Hello User";
           exit();
           header("location: /forum2/index.php");

        }
        else{
            echo "password do not match";
            header("location: /forum2/index.php");
        }
    }
}
else{
    echo "Do not enter in the loop ";
}

?>