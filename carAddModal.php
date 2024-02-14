<!-- Modal -->
<div class="modal fade" id="carAddModal" tabindex="-1" aria-labelledby="carAddModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carAddModalLabel">Car Add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php

// if ($_SERVER['REQUEST_METHOD'] =='POST'){
//   $car_name = $_POST['car_name'];
//   $car_desc = $_POST['car_desc'];
//   $car_rate = $_POST['car_rate'];

$servername = "localhost";
$username = "root";
$password = "";
$database = "car";

$conn = mysqli_connect($servername, $username, $password,$database);

  if(isset($_POST['submit'])){
    $car_name = $_POST['car_name'];
    $car_desc = $_POST['car_desc'];
    $car_rate = $_POST['car_rate'];
    $file = $_FILES['car_img'];
 

    $filename = $file['name'];
            $fileerror = $file['error'];
            $filepath = $file['tmp_name'];

              if($fileerror == 0){
                  $destinationfile = 'Upload/'.$filename;
                //   echo "$destinationfile";
                move_uploaded_file($filepath,$destinationfile);

               


                $sql = "INSERT INTO `car` (`car_name`, `car_desc`, `car_rate`, `car_img`, `car_add_dt`) VALUES ( '$car_name', '$car_desc', '$car_rate', '$destinationfile', current_timestamp())";

          $result = mysqli_query($conn, $sql);

                

                if($result){
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
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


                


                    <div class="container mt-3">
                        <h1>Please our Information </h1>

                        <form action="index.php" method="post" enctype="multipart/form-data">
            
            <div class="form-group">
            <label for="name" class="form-label">Car Name</label>
                                <input type="text" class="form-control" id="car_name" name="car_name"
                                    aria-describedby="emailHelp" required>
                                <label for="address" class="form-label"> Car Description</label>
                                <textarea class="form-control" id="car_desc" name="car_desc" rows="3" required></textarea>
                                <label for="name" class="form-label">Car Rate</label>
                                <input type="text" class="form-control" id="car_rate" name="car_rate"
                                    aria-describedby="emailHelp" placeholder="₹/KM" required>
                <label for="email">Car Image</label>
                <input type="file" name="car_img" class="form-control" id="address" aria-describedby="emailHelp" required>
            </div>

           <input type="submit" name="submit" value="Submit" class="btn btn-primary my-1">

        </form>
                </div>


            </div>

        </div>
    </div>
</div>