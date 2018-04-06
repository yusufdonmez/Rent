<?php
    require('./readDataConfig.php');
    $id = $_GET['id'];
    
        $sql = ("DELETE FROM kullanicilar WHERE id=".$id);
        $result = mysqli_query($link, $sql);
                    
    	header("location:newReadUsers.php");
 
?>
