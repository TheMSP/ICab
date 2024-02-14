<?php
session_start();

// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
//     header("location: partial/login.php");
//     exit;
// }

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>ICaB - <?php echo $_SESSION['username'];?> </title>
</head>

<body>
    <?php include 'partial/_header.php'; ?>
    <?php include 'partial/_dbconnect.php'; ?>


   
        <div class="search">
            <h1>Search Result for " <?php echo $_GET["search"]  ?> "</h1>

            <?php

$noresults = true;
$query = $_GET["search"];

            $sql = "select * from `car` where match (car_name, car_desc) against ('$query')"; 
            $result = mysqli_query($conn, $sql);
            
            // <!-- use a loop to iterate categories -->

            while($row = mysqli_fetch_assoc($result)){
                $car_name = $row['car_name'];
                $desc = $row['car_desc']; 
                $car_id= $row['car_id'];
                $url = "urban.php?car_id=".$car_id;
                $noresults = false;

                echo '<div class="result">
                <h3><a href="'.$url.'"> '. $car_name .'</a> </h3>

                <p>'. $desc .'
                

                </div>';
            } 

            if ($noresults){
                echo '<div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <p class="display-4">No Results Found</p>
                            <p class="lead"> Suggestions: <ul>
                                    <li>Make sure that all words are spelled correctly.</li>
                                    <li>Try different keywords.</li>
                                    <li>Try more general keywords. </li></ul>
                            </p>
                        </div>
                     </div>';
            }      
              
            ?>

            
        </div>
        
           <!-- <?php include '_footer.php' ;?> -->
                <!-- Optional JavaScript; choose one of the two! -->

                <!-- Option 1: Bootstrap Bundle with Popper -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                    crossorigin="anonymous">
                </script>

                <!-- Option 2: Separate Popper and Bootstrap JS -->
                <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>