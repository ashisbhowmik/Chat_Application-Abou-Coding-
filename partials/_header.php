<?php
  

  session_start();
   

echo '
 
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
<img src="img/Ashis.png" width="60px"/>
  <a class="navbar-brand" href="/forum2">AshisBhowmik.com</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/forum2">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Components
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" >Contact Us</a>
      </li>
    </ul>
      <form class="d-flex" action="search.php" method="get">
      <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
      <button class="btn btn-danger" type="submit">Search</button>
      </form>';

      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true ) {

       echo  '<p class="text-dark my-0 mx-2">Welcome: '.$_SESSION['useremail'].'</p>
       <a href="/forum2/partials/_logout.php" class="btn btn-outline-success mx-2">LogOut</a>';
      }
      else{
        echo '<a class="btn btn-outline-danger mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</a>
        <a href="/forum2/partials/_handleLogin.php" class="btn btn-outline-danger mx-0"> LogIn</a>';
      }
        echo '</div>
          </div>
          </nav>';


    // include 'partials/_loginmodal.php';
    include 'partials/_signupmodal.php';
    // include '_handleLogin.php';


    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true" ) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Account has been created! You can now LogIn
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false" ) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Alert!</strong> Username already Exists! Please select another username to signup
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "no" ) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Alert!</strong> Password doesn"t match!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }



    // if ($login) {
    //   echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    //     <strong>Success!</strong> You are loggIn Now!
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    // </div>';
    // }
    // if ($error) {
    //   echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //     <strong>Alert!</strong> Invalid Credential!
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    // </div>';
    // }

    // if ($_GET['loginsuccess'] == "true" ){
    //   echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    //     <strong>Success!</strong> You are now logged In..Enjoy our website!
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    // </div>';
    // }

    
    // else if ($_GET['loginsuccess'] == "false" ){
    //   echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //     <strong>Alert!</strong> Password Do not match
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    // </div>';
    // }
    // else if ($_GET['loginsuccess'] == "no" ){
    //   echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //     <strong>Alert!</strong> Username do not exists!
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    // </div>';
    // }
     

?>