<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Contact Us</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Get/Post</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/cwhphp/21_Get_Post.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <?php
          
      
      // Connecting to the Database
      $servername = "localhost";
      $username = "root";
      $password = "";
      $database = "car";


      $conn = mysqli_connect($servername, $username, $password, $database);

      if(isset($_POST['submit'])){
        $car_name = $_POST['car_name'];
        $car_desc = $_POST['car_desc'];
        $car_rate = $_POST['car_rate'];
          $file = $_FILES['car_img'];


        //   print_r($car_name);
        //   print_r($car_desc);
        //   print_r($file);
          
            $filename = $file['name'];
            $fileerror = $file['error'];
            $filepath = $file['tmp_name'];

              if($fileerror == 0){
                  $destinationfile = 'Upload/'.$filename;
                //   echo "$destinationfile";
                move_uploaded_file($filepath,$destinationfile);

                $sql = "INSERT INTO `car` ( `car_name`, `car_desc`,`car_rate`, `car_img`, `car_add_dt`) VALUES ('$car_name', '$car_desc', '$car_rate','$destinationfile', current_timestamp())";

                $result = mysqli_query($conn, $sql); 

                if($result){ 
                    $insert = true;
                }
                else{
                    echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
                }

              }
        }

?>

    <div class="container mt-3">
        <h1>Contact us for your concerns</h1>
        <form action="/project/img.php" method="post" enctype="multipart/form-data">
            
            <div class="form-group">
            <label for="name" class="form-label">Car Name</label>
                                <input type="text" class="form-control" id="car_name" name="car_name"
                                    aria-describedby="emailHelp">
                                <label for="address" class="form-label"> Car Description</label>
                                <textarea class="form-control" id="car_desc" name="car_desc" rows="3"></textarea>
                                <label for="name" class="form-label">Car Rate</label>
                                <input type="text" class="form-control" id="car_rate" name="car_rate"
                                    aria-describedby="emailHelp" placeholder="₹/KM">
                <label for="email">Car Image</label>
                <input type="file" name="car_img" class="form-control" id="address" aria-describedby="emailHelp">
            </div>

           <input type="submit" name="submit" value="Submit" class="btn btn-primary">

        </form>
    </div>

        <!-- insert item -->

        

        <div class="container">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Car Name</th>
      <th scope="col">car Desc</th>
      <th scope="col">Image</th>
    </tr>
  </thead>
  <tbody>
  <?php 
          $sql = "SELECT * FROM `car`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
              ?>
          
<tr>

<td><?php echo $row['car_name']; ?></td>
<td><?php echo $row['car_desc']; ?></td>
<td><img src="<?php echo $row['car_img']; ?>" width="80" alt=""></td>

</tr>

       <?php       
          
        } 
          ?>
    </tbody>
</table>
        </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>