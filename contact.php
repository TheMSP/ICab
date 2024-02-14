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
    <link rel="stylesheet" href="contact_Style.css">

    <title>Contact Us</title>
  </head>
  <body>
  <?php include 'partial/_header.php'; ?>
  
  <section class="Contact msp">
  <form action="" method="post">
      <div class="container py-5">
     
          <div class="row">
              <div class="col-lg-6 mx-auto">
                  <div class="card">
                      <div class="card-body">
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="head text-center text-white py-3">
                                      <h3>Contact Us</h3>
                                  </div>
                              </div>
                          </div>
                          
                          <div class="form p-3">
                              <div class="form-row my-5">
                                  <div class="">
                                     
                                      <span class="Focus-border col-lg-12 "> <input type="text" class="effect-1" name="name" placeholder="Enter Your Name"></span>
                                  </div>
                                
                              </div>
                              <div class="form-row ">
                                  <div class="col-lg-12">
                                  <input type="email" name="email" class="effect-1" placeholder="Email Address">
                                      <span class="Focus-border"></span>
                                  </div>
                              </div>
                              <div class="form-row pt-5">
                                  <div class="col-lg-12">
                                  <input type="text" name="message" class="effect-1" placeholder="Your Message">
                                      <span class="Focus-border"></span>
                                  </div>
                              </div>
                              <div class="form-row pt-4">
                                  <!-- <div class="col-lg-6">
                                    <p><input type="checkbox">I'M Not a Robort</p>
                                  </div> -->
                                  <div class="offset-2 col-lg-4">
                                        <!-- <button class="btn1" name="send">Send Message</button> -->
                                        <input type="submit" name="esubmit" class="btn1" value="Send Message">
                                  </div>
                                
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
            
      </div>
      </form>
  </section>

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
