<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <!-- <body> -->
  <body>
  <?php include 'partial/_dbconnect.php'; ?>

  <?php

$car_id=$_GET['car_id'];
$sql = "select * from `car` where `car_id` = $car_id"; 
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
?>

<html>
<head></head>
<body>
    <form method='post' action="test.php?car_id=<?php echo $row['car_id'];?>" enctype="multipart/form-data"> getting id
        <input type='hidden' name='car_id' value=""><br><br>
            name: <input type='text' name='car_name'><br><br>
            car_desc: <input type='text' name='car_desc'><br><br>
            car_rate: <input type='text' name='car_rate'><br><br>    
        Car image: <input type='file' name='car_img' value=""><br><br> 
        <img src="upload/<?php //echo $row[6]?>" style="width:100px;height:100">
        <input type='submit' name='submit' value='submit'>
    </form>

<?php
if(isset($_POST['submit']))
{
    $car_=$_POST['car_id'];   
    $car_name=$_POST['car_name'];
    $car_desc=$_POST['car_desc'];
    $car_rate=$_POST['car_rate'];
    $car_img=$_FILES['car_img']['name'];
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["car_img"]["name"]);
    $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["car_img"]["tmp_name"], $target_file)) 
    {
        $sql="UPDATE `car` SET `car_name` = '$car_name' , `car_desc` = '$car_desc', `car_rate` = '$car_rate', `car_img` = '$car_img' WHERE `car`.`car_id` = $car_id";
        if(mysqli_query($conn,$sql))
        {
            header('location:msp.php');
        }
        else 
        {
            echo 'not updated';
        }
    }
}
?>

</body>
</html>

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