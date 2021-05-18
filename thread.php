<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <title>Threads Session</title>
</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>

    <?php
                $id = $_GET['threadid'];
                $noResult = true;
                $sql = "SELECT * FROM `threads` WHERE thread_id ='$id'";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result))
                {
                    $title = $row['thread_title'];
                    $desc = $row['thread_desc'];
                    $noResult = false;                 
                }
                ?>
    <!-- category container starts here -->
    <div class="container my-3">
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="h-100 p-5 text-white bg-dark rounded-3">
                    <h2>
                        <?php echo $title; ?>
                        : forums
                    </h2>
                    <p><?php echo $desc; ?> </p>
                </div>
            </div>
        </div>
    </div>



    <?php
            $showAlert = false;
            $method  = $_SERVER['REQUEST_METHOD'];
            if ($method=='POST') 
            {
            $comment = $_POST['comment'];
            $comment = str_replace("<", "&lt;", $comment);
            $comment = str_replace(">", "&gt;", $comment);
            $sno = $_POST['sno'];
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`,`comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";
            $result = mysqli_query($conn,$sql);
            $showAlert = true;
            if ($showAlert) {
                echo '<div class="container"> 
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Comment has been added
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            </div>';
            }

    }
    ?>




    <!-- container -->
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true) {
    
            echo '<div class="container" id="ques">
                <h2 class="text-dark pb-2">Discuss Your comments</h2>
                <div class="container">
                    <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
            <!-- PHP_SELF is used for making post request in the same page that the data is being showed in the page -->
            <div class="mb-3">
                <label for="comment" class="form-label text-dark">Type your comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            <button type="submit" class="btn btn-primary">Post Answer</button>
            </form>
            </div>';}
    
    else{
        echo '<div class="container"> 
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Alert!</strong> You can"t post your answer becuase you are not logged In, Please Login to post your answer
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    </div>
    ';
    }
    ?>

    <div class="container my-5">
        <h2>Discussions</h2>
        <?php
            $id = $_GET['threadid'];
            $sql = "SELECT * FROM `comments` WHERE thread_id= '$id'";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)) {
            $id = $row['comment_id'];
            $time = $row['comment_time'];
            $content = $row['comment_content'];
            $noResult = false;
            $comment_by = $row['comment_by'];  
            
            $sql2 = "SELECT `user_email` from `users` WHERE `users`.`sno`='$comment_by'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            // $user = $row2['user_email'];


            echo '
            <hr>
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object" src="img/users.jpg" width="34px" alt="">
                    </a>
                </div>
                <div class="media-body mb-5">
                <p class="font-weight-bold my-0">'.$row2['user_email'].': at '. $time.'</p><b> '. $content .'</b>
                </div>
            </div>';
            }

            if($noResult)
            {
            echo '<div class="jumbotron">
                <h1 class="text-dark mx-5 my-4">No Result Found!</h1>
                <p class="text-dark mx-5 my-0">Be the first Person to ask a question!</p>
            </div>';
            }
            ?>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>

</html>
