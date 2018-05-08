<?php
    error_reporting(0);
    include "config.php";
    if($_SESSION['type'] === "musteri"){
    header("location:login.php");
    die();
    }
    
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    if(!filter_var($id, FILTER_VALIDATE_INT)){
    	header("location:newReadCars.php");
    	die();
    }
    $sql = ("DELETE FROM cars WHERE id=".$id);
    $result = mysqli_query($link, $sql);
                    
    header("location:newReadCars.php");
?>

