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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Urban</title>

    <style>
      .msp{
        height: 180px;
        width: 180px;
      }
    </style>

  </head>
  <body>
  <?php include 'partial/_header.php'; ?>
  <?php include 'partial/_dbconnect.php'; ?>


  
 
  
  <?php

        $car_id = $_GET['car_id'];

        $sql = "SELECT * FROM `car` WHERE car_id=$car_id"; 
        $result  = mysqli_query($conn, $sql);

          while($row = mysqli_fetch_assoc($result)){
            $name = $row['car_name'];
            $car_id = $row['car_id'];
            $car_desc = $row['car_desc'];
            $car_rate = $row['car_rate'];
          
echo '

    
  <div class="container py-3">
  
                
  <main>
    <div class="row row-cols-1 row-cols-md-1 mb-1 text-center">
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">';?><img src=" <?php echo $row['car_img']; ?> " <?php echo ' class="card-img-top rounded-20 msp" alt="..." '?>><?php echo ' </h4>
          </div>
          <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal">';?> <?php echo $name; ?><?php echo'</h1>
      <h6 ">';?> <?php echo 'Car Id '. $car_id ; ?><?php echo'</h6>
      <p class="fs-5 text-muted">';?><?php echo $car_desc; ?><?php echo '</p>
    </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">';?>₹<?php echo $car_rate ; ?><?php echo '<small class="text-muted fw-light">/km</small></h1>
            <ul class="list-unstyled mt-1 mb-1">
             
            </ul>
            <a href="booking.php?car_id='. $car_id .'"><button type="button" class="w-100 btn btn-lg btn-outline-warning">Book Now</button></a>
          </div>
        </div>
      </div>
    </div>

    
  </main>'
  
;
 }
?>


  <?php include 'partial/_footer.php' ;?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>