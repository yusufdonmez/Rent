<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
    die();
}
$oturumOmru =1*60;
      
if (isset($_SESSION['baslangicZamani'])) {
    $oturumSuresi = time() - $_SESSION['baslangicZamani'];
    if ($oturumSuresi > $oturumOmru){
        echo "Oturum süreniz dolmuştur..."; 
        header("location: logout.php");
    }
}
//$_SESSION['baslangicZamani'] = time();  
//echo $_SESSION['id'];
?>