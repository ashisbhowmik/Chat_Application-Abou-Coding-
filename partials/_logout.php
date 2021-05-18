<?php
    echo "Loggin you out! Please wait";
    session_start();
    session_unset();
    session_destroy();
    header("location: /forum2");
    exit();
?>