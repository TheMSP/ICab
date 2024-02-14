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
    <?php include 'partial/header.php'; ?>
    <?php include 'partial/dbconnect.php'; ?>
   

    <!-- Slider Start here -->

    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/1.jfif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/2.jfif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/3.jfif" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>

    <!-- Urban Catrgory Name -->

    <div class="container-fluid bg-warning text-light my-2">
        <h1 class="d-flex justify-content-center my-2"> Welcome To ICaB</h1>
        <!-- <h1 class="d-flex justify-content-center"> Wellcome To ICaB</h1> -->
        <span class="">
            <button class="btn btn-warning btn-sm mb-2 my-2 mx-2 float-end" data-bs-toggle="modal"
                data-bs-target="#carAddModal">Add New Car</button>
        </span>
    </div>


<!-- Card Start here -->
<div class="container my-2">
        <div class="row">
            
            <!-- Fetch All the categories -->
            <?php
              $sql = "SELECT * FROM `car`"; 
            $result  = mysqli_query($conn, $sql);
            
            // <!-- use a loop to iterate categories -->

              while($row = mysqli_fetch_assoc($result)){
                  
                // echo $row['categories_id'];
                // echo $row['categories_name'];
                
                $car_id = $row['car_id'];
                $name = $row['car_name'];
                $car_desc = $row['car_desc'];
                echo ' <div class="col-md-3 mb-2">
                <div class="card" style="width: 18rem;">';?>
                <img src="<?php echo $row['car_img']; ?>"  class="card-img-top rounded-20" height = "180" alt="..."><?php echo '
                <div class="card-body">
                <h5 class="card-title">'. $name . '</h5>
                        <p class="card-text">'. substr($car_desc,0,90) .' ...</p>
                        <a href="/project/urban.php?car_id='. $car_id .'" class="btn btn-warning">Read more</a>
                    </div>
                </div>
            </div>';
            
              } 

              
              ?>


        </div>
    </div>


    
        <!-- Rural Catrgory Name -->


        
           <?php include 'partial/_footer.php' ;?>
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