<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>View Threads Session</title>
    <style>
    #ques {
        min-height: 433px;
    }
    </style>
</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>



    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id = '$id'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result))
    {
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];

    }
  
?>
    <div class="container my-3">
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="h-100 p-5 text-white bg-dark rounded-3">
                    <h2>Welcome to <?php echo $catname ;?> forums</h2>
                    <p> <?php echo $catdesc; ?> </p>
                    <button class="btn btn-outline-light" type="button">Learn More</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="ques">
        <h2 class="text-center text-dark  pb-2">Ask Your Questions</h2>


        <!-- category container starts here here -->
        <?php
                $showAlert = false;

                $method = $_SERVER['REQUEST_METHOD'];
                if ($method=='POST') 
                {
                // insert thread into database
                $th_title = $_POST['title'];
                $th_desc = $_POST['desc'];
                $sno = $_POST['sno'];
                $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`,`tthread_user_id`, `time`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
                $result = mysqli_query($conn,$sql);
                $showAlert = true;
                if ($showAlert) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your Question has been submitted. Please wait until you got replied by someone
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                }                
            }
            ?>

        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true) {
                echo '<div class="container">
                <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                <div class="mb-3">
                    <label for="title" class="form-label text-dark">Your Query</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="mb-3">
                    <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                    <label for="desc" class="form-label text-dark">Elaborate Your Problems</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>';}

            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Alert!</strong> You are not Logged In. Please Login First to ask your question
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            ?>



        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id='$id'";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_user_id = $row['tthread_user_id'];
            $time = $row['time'];
            $noResult = false;

            $sql2 = "SELECT user_email from users WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            


            echo '<hr>
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" src="img/users.jpg" width="34px">
                        </a>
                    </div>
                    <div class="media-body mb-5">
                        <h3><a class="text-dark" href="thread.php?threadid='.$id .'">'. $title .'</a></h3>
                    '. $desc .'
                    <p class="font-weight-bold my-0">'.$row2['user_email'].' : in '. $time.'</p>

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



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
        </script>

</body>

</html>