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

     <div class="container my-4 ">
         <h3>Search Result for <em>"<?php echo $_GET['search'];?>"</em></h3>

         <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
        $noResult = true;
        $query = $_GET['search'];
        $sql = "SELECT * FROM `threads` WHERE MATCH (thread_title, thread_desc) against('$query')";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_id = $row['thread_id'];


        $noResult = false;
        // thread.php?threadid=1 
        echo '<div class="result my-4">
            <h4><a href="thread.php?threadid='.$thread_id.'" class="text-dark">'.$title.'</a></h4>
            <p>'. $desc .'</p>
        </div>';
        }
        if($noResult)
            {
            echo '<div class="container my-3">
            <div class="row mb-5">
                <div class="col-md-6">
                    <div class="h-100 p-5 text-white bg-dark rounded-3">
                    <h2>No Result found in this <em>"'.$query.'"</em> Keyword!</h2>
        <ul>
            <li>Make sure that all words are spelled correctly.</li>
            <li>Try different keywords.</li>
            <li>Try more general keywords</li>
        </ul>
    </div>
    </div>
    </div>
    </div>';
    }
}

    else{
        echo '<div class="alert alert-danger alert-dismissible fade show my-5" role="alert">
        <strong>Alert !</strong> Please Login First to Search your Question!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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

 </html>