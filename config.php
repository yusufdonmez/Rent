<?php
    error_reporting(0);
//$db = new pdo('mysql:host=localhost;dbname=rent','root','root');
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
    switch ($_SESSION['type']) {
    	case 'yonetici':
    		define('DB_USERNAME', 'yonetici');
			define('DB_PASSWORD', 'sm4eUx5ZFzehBb8A');
    		break;
    	case 'calisan':
    		define('DB_USERNAME', 'calisan');
			define('DB_PASSWORD', 'sm4eUx5ZFzehBb8A');
    		break;
    	case 'musteri':
    		define('DB_USERNAME', 'musteri');
			define('DB_PASSWORD', 'sm4eUx5ZFzehBb8A');
    		break;
    	default:
    		//header("location:logout.php");
    		die();
    		break;
    }
define('DB_SERVER', 'localhost');
//define('DB_USERNAME', 'rent');
//define('DB_PASSWORD', 'sm4eUx5ZFzehBb8A');
define('DB_NAME', 'rent');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>