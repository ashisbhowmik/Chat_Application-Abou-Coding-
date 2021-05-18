<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Coding Discuss</title>
</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>

    <!-- category container starts here here -->
    <div class="container my-5">
        <h2 class="text-center mb-5">iDiscuss - Categories</h2>
        <div class="row">

            <!-- fetch all the categories -->
            <?php
                $sql  = "SELECT * FROM `categories`";
                $result = mysqli_query($conn, $sql); 
                while($row = mysqli_fetch_assoc($result)){
                      $id = $row['category_id'];
                      $cat = $row['category_name'];
                      $desc = $row['category_description'];
                echo'     
                      <div class="col-md-4 my-2">
                        <div class="card" style="width: 18rem;">
                        
                         <img src="img/pic'. $id .'.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><a href="/forum2/viewthreads.php?catid='. $id .'">'. $cat .'</a></h5>
                            <p class="card-text">'. substr($desc,0,90) .'
                                card\'s content.</p>
                            <a href="/forum2/viewthreads.php?catid='. $id .'" class="btn btn-primary">View Threads</a>
                        </div>
                    </div>
                </div>';
                 }
            ?>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>