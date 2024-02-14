<?php
include '_dbconnect.php';

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
}
else{
  $loggedin = false;
}
echo '<nav class="navbar navbar-expand-lg navbar-primary bg-primary">
<div class="container-fluid">
<a class="navbar-brand" href="/project"><img class="" src="img/ICab Logo.png" alt="LOGO"
width="50"></a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
      <a class="nav-link active text-light" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
      <a class="nav-link active text-light"" aria-current="page" href="about.php">About</a>
      </li>
      <li class="nav-item">
      <a class="nav-link active text-light"" aria-current="page" href="contact.php">Contact</a>
      </li>
      <li class="nav-item">
      <a class="nav-link active text-light"" aria-current="page" href="admin.php">Administration</a>
      </li>
    </ul>';
    if(!$loggedin){
      echo '
      <div class="mx-2">
    
      <a href="http:partial/signup.php"><button class="btn btn-outline-warning">SignUp </button></a>
  
      <a href="http:partial/login.php"><button class="btn btn-outline-warning">LogIn</button></a>
      </div>';
    }
    if($loggedin){
      echo '
    <div class="mx-2">
    <img src="img/user.jpg" width="40" class="rounded-circle  alt=""><span class="text-white mx-2">' ; echo strtoupper( $_SESSION['username']); echo'</span>
    <a href="http:partial/logout.php"><button class="btn btn-outline-warning">Logout</button></a>
    </div>';
    }
    echo '
    <form class="d-flex" action="search.php" method="get">
    <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-warning" type="submit">Search</button>
  </form>
   
  
  </div>
</div>
</nav>';


?>

<?php

// include 'partial/loginModal.php';
// include 'partial/signup.php';
include 'carAddModal.php';
include 'ruralCarAdd.php';
include 'addAuto.php';
// include 'partial/login.php';


?>