<?php
    error_reporting(0);
	include "config.php";
    if($_SESSION['type'] != "yonetici"){
        header("location:index.php");
        die();
    }

    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    if(!filter_var($id, FILTER_VALIDATE_INT)){
    	header("location:newReadUsers.php");
    	die();
    } 

    $sql = ("DELETE FROM kullanicilar WHERE id=".$id);
    $result = mysqli_query($link, $sql);
                    
    header("location:newReadUsers.php");
 
?>
