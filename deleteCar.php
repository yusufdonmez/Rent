<?php
    //require('./readDataConfig.php');
	include "config.php";
    $id = $_GET['id'];
    
        $sql = ("DELETE FROM cars WHERE id=".$id);
        $result = mysqli_query($link, $sql);
                    
    	header("location:newReadCars.php");
?>

