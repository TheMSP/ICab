<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Edit Image</title>
</head>

<body>
    <div class="container my-4">
        <h2>Add a Note to iNotes</h2>

        <?php include 'partial/_dbconnect.php'; ?>
        <?php
$car_id = $_GET["car_id"];
$sql ="SELECT * FROM `car` WHERE car_id='$car_id' ";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0){
foreach($result as $row){
//  echo $row["car_name"];
?>
        <form action="/project/code.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="car_id" value="<?php echo $row["car_id"];?>">
            <div class="form-group">
                <label for="name" class="form-label">Car Name</label>
                <input type="text" class="form-control" id="car_name" name="car_name"
                    value="<?php echo $row["car_name"]; ?>" aria-describedby="emailHelp">
                <label for="address" class="form-label"> Car Description</label>
                <textarea class="form-control" id="car_desc" name="car_desc" value="<?php echo $row["car_desc"]; ?>"
                    rows="3"></textarea>
                <label for="name" class="form-label">Car Rate</label>
                <input type="text" class="form-control" id="car_rate" name="car_rate"
                    value="<?php echo $row["car_rate"]; ?>" aria-describedby="emailHelp" placeholder="₹/KM">
                <label for="email">Car Image</label>
                <input type="file" name="car_img" class="form-control" id="car_img"
                     aria-describedby="emailHelp">
                <input type="hidden" name="car_img_old" class="form-control" id="car_img_old"
                    value="<?php echo $row["car_img"]; ?>" aria-describedby="emailHelp">
                    <img src="<?php echo "upload/".$row["car_img"];?>" width="100px;" alt="">
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update Data</button>
        </form>
        <?php
}
}
else{
    echo "No Record Available";
}

  ?>





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