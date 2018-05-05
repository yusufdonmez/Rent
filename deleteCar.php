<?php
    //require('./readDataConfig.php');
	include "config.php";
    
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    if(!filter_var($id, FILTER_VALIDATE_INT)){
    	header("location:newReadCars.php");
    	die();
    }
    $sql = ("DELETE FROM cars WHERE id=".$id);
    $result = mysqli_query($link, $sql);
                    
    header("location:newReadCars.php");
?>

