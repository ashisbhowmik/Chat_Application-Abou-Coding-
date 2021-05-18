<?php

    $showAlert = false;
    $showError1 = false;
    // $showError2 = false;
    
    

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        include '_dbconnect.php';

        $username = $_POST['username'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];

        // check wheather this email exists

        $existsSql = "SELECT * FROM `users` WHERE user_email='$username'";
        $result = mysqli_query($conn, $existsSql);
        $numRows = mysqli_num_rows($result);
        if ($numRows>0) {
            $showError1 = true; // "Username Already Exists";
        }
        else{
            if ($pass == $cpass) {
                // $hash = password_hash($pass, PASSWORD_DEFAULT);
                // $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `date`) VALUES ('$username', '$hash', current_timestamp())";
                $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `date`) VALUES ('$username', '$pass', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $showAlert = true; 
                    header("location: /forum2/index.php?signupsuccess=true");
                    exit();
                }
            }
            else{
                $showError2  = true; //"Password do not match";
            }
        }
        if ($showError2) {
            header("location: /forum2/index.php?signupsuccess=no");
            exit();
        }
    
        if ($showError1) {
            header("location: /forum2/index.php?signupsuccess=false");
            exit();

            
        }

    }
   

?>