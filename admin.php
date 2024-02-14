<?php
session_start();

// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
//     header("location: partial/login.php");
//     exit;
// }

?>
<?php  
include 'partial/_dbconnect.php'; 

// INSERT INTO `notes` (`sno`, `title`, `des`, `tstamp`) VALUES (NULL, 'But Books', 'Please buy books from Store', current_timestamp());
$insert = false;
$update = false;
$delete = false;


if(isset($_GET['delete'])){
  $car_id = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `car` WHERE `car_id` = $car_id";
  
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['car_idEdit'])){
  // Update the record
    $car_id = $_POST["car_idEdit"];
    $car_name = $_POST["car_nameEdit"];
    $car_desc = $_POST["car_descEdit"];
    $car_rate = $_POST["car_rateEdit"];
    // $car_img = $_FILES["car_imgEdit"]["name"];
    

  // Sql query to be executed
  $sql = "UPDATE `car` SET `car_name` = '$car_name' , `car_desc` = '$car_desc', `car_rate` = '$car_rate' WHERE `car`.`car_id` = $car_id";
  $result = mysqli_query($conn, $sql);
  
  if($result){
    
    $update = true;
}
else{
    echo "We could not update the record successfully". mysqli_error($conn);
}
}
else{
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
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


    <title>Admin Page</title>

</head>

<body>

<?php include 'partial/_header.php'; ?>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Car Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</spa>
                    </button>
                </div>
                <form action="/project/admin.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="car_idEdit" id="car_idEdit">
                        <!-- <div class="form-group">
                            <label for="title">CarId</label>
                            <input type="hidden" class="form-control" id="car_nameEdit" name="car_nameEdit" disabled
                                aria-describedby="emailHelp" placeholder="Car id can not be change">
                        </div> -->
                        <div class="form-group">
                            <label for="title">Car Name</label>
                            <input type="text" class="form-control" id="car_nameEdit" name="car_nameEdit"
                                aria-describedby="emailHelp">
                        </div>

                        <div class="form-group">
                            <label for="desc">Car Description</label>
                            <textarea class="form-control" id="car_descEdit" name="car_descEdit" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="title">Car Rate</label>
                            <input type="text" class="form-control" id="car_rateEdit" name="car_rateEdit"
                                aria-describedby="emailHelp">
                        </div>
                        <!-- <div class="form-group">
                            <label for="carimg">Car Image</label>
                            <input type="file" class="form-control" id="car_imgEdit" name="car_imgEdit"
                                aria-describedby="emailHelp">
                        </div> -->

                    </div>

                    <div class="modal-footer d-block mr-auto">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Car has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
    <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your car has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
    <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your car information has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
    <div class="container my-4">
        <h2>Add a New Car </h2>
        <form action="/project/admin.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name" class="form-label">Car Name</label>
                <input type="text" class="form-control" id="car_name" name="car_name" aria-describedby="emailHelp">
                <label for="address" class="form-label"> Car Description</label>
                <textarea class="form-control" id="car_desc" name="car_desc" rows="3"></textarea>
                <label for="name" class="form-label">Car Rate</label>
                <input type="text" class="form-control" id="car_rate" name="car_rate" aria-describedby="emailHelp"
                    placeholder="₹/KM">
                <label for="email">Car Image</label>
                <input type="file" name="car_img" class="form-control" id="address" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Add Now</button>
        </form>
    </div>

    <div class="container my-5">


        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">₹</th>
                    <th scope="col">Image</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php 
          $sql = "SELECT * FROM `car`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['car_id'] . "</td>";?>
                <td><?php echo  $row['car_name']; ?></td>
                <td><?php echo $row['car_desc']; ?></td>
                <td><?php echo $row['car_rate']." ₹"; ?></td>
                <td><img src="<?php echo $row['car_img']; ?>" width="80" alt=""></td>
              
               <?php echo " <td> <button class='edit btn btn-sm btn-primary' id=".$row['car_id'].">Edit</button></td>
                <td> <button class='delete btn btn-sm btn-primary' id=d".$row['car_id'].">Delete</button>  </td>
          </tr>";
        } 
          ?>


            </tbody>
        </table>
    </div>
    <hr>
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
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();

    });
    </script>
    <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit ");
            tr = e.target.parentNode.parentNode;
            // car_id = tr.getElementsByTagName("td")[0].innerText;
            car_name = tr.getElementsByTagName("td")[1].innerText;
            car_desc = tr.getElementsByTagName("td")[2].innerText;
            car_rate = tr.getElementsByTagName("td")[3].innerText;
            // car_img = tr.getElementsByTagName("td")[4].innerText;
            console.log(car_name, car_desc , car_rate );
            car_nameEdit.value = car_name;
            car_descEdit.value = car_desc;
            car_rateEdit.value = car_rate;
            // car_imgEdit.value = car_img;
            car_idEdit.value = e.target.id;
            console.log(e.target.id)
            $('#editModal').modal('toggle');
        })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit ");
            car_id = e.target.id.substr(1);

            if (confirm("Are you sure you want to delete this note!")) {
                console.log("yes");
                window.location = `/project/admin.php?delete=${car_id}`;
                // TODO: Create a form and use post request to submit a form
            } else {
                console.log("no");
            }
        })
    })
    </script>

<?php include 'partial/_footer.php' ;?>

</body>

</html>