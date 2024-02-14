<!-- Button trigger modal -->
<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){

    include '_dbconnect.php';
    $username = $_POST['username'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // $exists = false;

    $existSql = "SELECT * FROM `signup` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
        $showError = "Username Already Exists";
    }
    else{
        // $exists = false; 
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `signup` ( `username`, `email`, `number`, `address`, `password`, `sign_dt`) VALUES ('$username', '$email', '$number', '$address', '$password', current_timestamp())";

        $result = mysqli_query($conn, $sql);
            if ($result){
                $showAlert = true;
            }
        }
        else{
            $showError = "Passwords do not match";
        }
    }
}
    
?>


<!-- Modal -->
<!-- <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">SignUp for ICaB</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/project/index.php" method="post">
            <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" id="number" name="number" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword">
                    </div>
                   
                    <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
                  </div>
                </form>

        </div>
    </div>
</div> -->

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Signup</title>
    <style>
    #form {
        min-height: 800px;
    }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-primary bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/project"><img class="" src="ICab Logo.png" alt="LOGO"
                    width="50"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-light"" aria-current="page" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-light"" aria-current="page" href="contect.php">Contect</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-warning" type="submit">Search</button>
                </form>
                <div class="mx-2">
                    <button class="btn btn-outline-warning" data-bs-toggle="modal"
                        data-bs-target="#loginModal">LogIn</button>
                    <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp
                    </button>
                </div>

            </div>
        </div>
    </nav>

    <?php

if($showAlert){

echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong> SuccessFull</strong> 
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

if($showError){

echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong> ERROR</strong> '.$showError.'
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>

<div class="container mt-5" id="form">
    <form action="signup.php" method="post" class="row g-3">
    <div class="d-flex justify-content-center"><h2>Please Signup</h2></div>
        
            <div class="col-md-6">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" required>
            </div>
            <div class="col-md-6">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
            </div>
            <div class="col-md-6">
                <label for="exampleInputEmail1" class="form-label">Mobile Number</label>
                <input type="text" class="form-control" id="number" name="number" aria-describedby="emailHelp" required>
            </div>
            <div class="col-md-6">
                <label for="exampleInputEmail1" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" aria-describedby="emailHelp" required>
            </div>
            <div class="col-md-6">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="col-md-6">
                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" required>
            </div>

            <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>

            <!-- <div class="d-flex justify-content-center"><h6>Already Registered?  <button class="btn btn-sm btn-warning">LOGIN NOW!</button></h6></div> -->
            <div class="d-flex justify-content-center"><h6>Already Registered?  <a href="login.php"> LOGIN NOW!</a></h6></div>
        
    </form>

    </div>

    <?php include '_footer.php' ;?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>