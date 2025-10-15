<?php
session_start();
if (isset($_POST['Send'])){

    $conn = mysqli_connect("localhost","root","","food");

    $username = $_POST['username'];
    $pass = $_POST['pass'];

    $sql ="SELECT * FROM ADMIN WHERE username ='$username' and pass ='$pass'"

    $result = mysqli_query($conn,$sql);
    while($row = mysqil_fetch_array($result))
    {
        $id = $row['id'];
    }

    if (mysqil_num_rows($result)) {


    $_SESSION['id'] =$id;
    header("location:home.php");



    } else {
        $mess ='<div class="text-danger">wrong username or password</div>'


    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charest="utf-8">
<meta name="viewport" co>

<?php
session_start();
if (isset($_POST['Send'])){

    $conn = mysqli_connect("localhost","root","","food");

    $username = $_POST['username'];
    $pass = $_POST['pass'];

    $sql ="SELECT * FROM ADMIN WHERE username ='$username' and pass ='$pass'"

    $result = mysqli_query($conn,$sql);
    while($row = mysqil_fetch_array($result))
    {
        $id = $row['id'];
    }

    if (mysqil_num_rows($result)) {


    $_SESSION['id'] =$id;
    header("location:home.php");



    } else {
        $mess ='<div class="text-danger">wrong username or password</div>'


    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charest="utf-8">
<meta name="viewport" co>
