<?php include 'partial/_dbconnect.php'; ?>

<?php

if(isset($_POST["update"])){
    $car_id = $_POST["car_id"];
    $car_name = $_POST["car_name"];
    $car_desc = $_POST["car_desc"];
    $car_rate = $_POST["car_rate"];

    $new_img = $_FILES["car_img"]["name"];
    $old_img = $_POST["car_img_old"];
if($new_img != ''){

    $update_filename = $_FILES["car_img"]["name"];
}
else{
    $update_filename = $old_img;
}

if(file_exists("upload/" .$_FILES["car_img"]["name"])){
    $filename = $_FILES["car_img"]["name"];
    echo "Img already Exists" .$filename;
    header("location: msp.php");
}
else{
    $sql = "UPDATE `car` SET `car_name` = '$car_name' , `car_desc` = '$car_desc', `car_rate` = '$car_rate', `car_img` = '$update_filename' WHERE `car`.`car_id` = $car_id";
    $result = mysqli_query($conn, $sql);

    if($result){
        if($_FILES["car_img"]["name"] != ''){
            move_uploaded_file($_FILES["car_img"]["tmp"],"upload/".$_FILES["car_img"]["name"]);
            unlink("upload/".$old_img);
        }
        echo "Update Successfull";
        header("location: edit.php");
    }
    else{
        echo "Not Update ";
        header("location: msp.php");
    }
}

}
?>
