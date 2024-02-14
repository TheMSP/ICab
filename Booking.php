<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  
    header("location: partial/login.php");
    exit;
}

?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Booking</title>
    <style>
    #form {
        min-height: 500px;
    }
    </style>
  </head>
  <body>
  <?php include 'partial/_header.php'; ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->


<?php

if ($_SERVER['REQUEST_METHOD'] =='POST'){
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $from = $_POST['from'];
  $to = $_POST['to'];
  $departure_date = $_POST['departure_date'];
  // $carID = $_POST['carID'];
  

//    Submit these to a database 
// Connecting to the Database

$servername = "localhost";
$username = "root";
$password = "";
$database = "car";

// Create A Connection

$conn = mysqli_connect($servername, $username, $password,$database);

// Die if connection was not successfull

if (!$conn) {
    die(" Sorry we failed to connect :" . mysqli_connect_error());
}

else {

// SQL query to be executed

$sql = "INSERT INTO `booking` ( `name`, `phone`, `email`, `from`, `to`,`departure_date`,`dt`) VALUES ('$name', '$phone', '$email','$from','$to','$departure_date', current_timestamp())";
$result = mysqli_query($conn, $sql);


// Add a new data to in the database table

if($result){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success</strong> Your data has been submitted Successfully
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

else{
    echo "The record was not inserted  successfully because of this error ---> ".mysqli_error($conn);
}

}
}

?>


<div class="container  my-5 " id="form">

  <h2 class="container d-flex justify-content-center"> Submit Information </h2>
    <form action="booking.php" method="post" class="row g-3">
  <div class="col-md-6">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" required> 
  </div>
  <div class="col-md-6">
    <label for="exampleInputEmail1" class="form-label">Mobile No.</label>
    <input type="text" class="form-control" id="phone" name="phone" aria-describedby="emailHelp" required> 
  </div>
  <div class="col-md-6 offset-md-3 text-center">
    <label for="exampleInputEmail1" class="form-label ">Email</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required> 
  </div>
  <div class="col-md-12">
    <h1>BOOK DETAIL</h1>
</div>
  <div class="col-md-6">
    <label for="exampleInputEmail1" class="form-label">From City </label>
    <input type="text" class="form-control" id="from" name="from" aria-describedby="emailHelp" required> 
  </div>
  <div class="col-md-6">
    <label for="exampleInputEmail1" class="form-label">To City</label>
    <input type="text" class="form-control" id="to" name="to" aria-describedby="emailHelp" required> 
  </div>
  <div class="col-md-6 offset-md-3 text-center">
    <label for="exampleInputPassword1" class="form-label">Departure Date</label>
    <input type="date" class="form-control" id="departure_date" name="departure_date" required>
  </div>
  <?php include 'partial/_dbconnect.php'; ?>
 
  <!-- <div class="col-md-6">
    <label for="exampleInputPassword1" class="form-label">Car ID</label>
    <input type="text" class="form-control" id="carID" name="carID" value="" >
  </div> -->

  <button type="submit" name="esubmit" class="btn btn-warning w-100">Submit</button>
</form>
    </div>  


    <?php include 'partial/_footer.php' ;?>


    </body>
</html>


<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once 'src/Exception.php';
require_once 'src/PHPMailer.php';
require_once 'src/SMTP.php';

$mail = new PHPMailer(true);

$alert = '';

if(isset($_POST['esubmit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $departure_date = $_POST['departure_date'];
  // $car_id = $_POST['car_id'];

  try{
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'themsp3@gmail.com'; // Gmail address which you want to use as SMTP server
    $mail->Password = '86@themsp'; // Gmail address Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = '587';

    $mail->setFrom('themsp3@gmail.com'); // Gmail address which you used as SMTP server
    $mail->addAddress($email); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)

    $mail->isHTML(true);
    $mail->Subject = 'Thank You for Booking';
    $mail->Body = "<div>Hey</div>
    <p><strong>$name </strong> Thank You For Booking</p>
    <p>Your Departure Date <strong>$departure_date</strong></p>
    <p>Have a nice day</p>";

    $mail->send();
    $alert = '<div class="alert-success">
                 <span>Message Sent! Thank you for contacting us.</span>
                </div>';
  } catch (Exception $e){
    $alert = '<div class="alert-error">
                <span>'.$e->getMessage().'</span>
              </div>';
  }
}
?>
