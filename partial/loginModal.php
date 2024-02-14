<?php

    $login = false;
    $showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST" ){

    include 'partial/_dbconnect.php';
    $email = $_POST["email"];
    $password = $_POST["password"];

//     $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "car";

// // Create A Connection

// $conn = mysqli_connect($servername, $username, $password,$database);


        $sql = "Select * from signup WHERE email = '$email' AND password = '$password'";

        $result = mysqli_query($conn, $sql);
        $num  = mysqli_num_query($result);
        if($num == 1){
            while($row=mysqli_fetch_assoc($result)){
            if (password_verify($password, $row['password'])){ 

            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header("location:index.php");

        }
        else{
            $showError = "Invalid Credentials ";
        }
    }
}
else{
    $showError = "Invalid Credentials";
}
}

?>

<?php

if($login){

echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong> SuccessFull</strong> You are logged in
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



<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login to ICaB</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
            <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    
                    <button type="submit" class="btn btn-primary" name="submit" id="submit">LogIn</button>
                  </div>
                </form>

        </div>
    </div>
</div>