<?php
    include "config.php";
    //require('./readDataConfig.php');
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    if(!filter_var($id, FILTER_VALIDATE_INT)){
        header("location:newReadCars.php");
        die();
    } 

    if (isset($_POST['submit'])) {
    	$id = $_POST['id'];
    	$username = filter_var($_POST['username'],FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
    	$password = md5(filter_var($_POST['password'],FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH));
    	$yetki = filter_var($_POST['yetki'],FILTER_FLAG_STRIP_HIGH,FILTER_SANITIZE_STRING);
    	if(empty($_POST['password'])){
    		$sql = ("UPDATE kullanicilar SET username = (?), type = (?) WHERE id = (?)");	
    		$stmt = mysqli_prepare($link, $sql);
        	mysqli_stmt_bind_param($stmt, "sss", $username,$yetki,$id);
    	}else{
			$sql = ("UPDATE kullanicilar SET username = (?), password = (?), type = (?) WHERE id = (?)");
        	$stmt = mysqli_prepare($link, $sql);
        	mysqli_stmt_bind_param($stmt, "ssss", $username, $password,$yetki,$id);    		
    	}
        mysqli_stmt_execute($stmt);

    	header("location:newReadUsers.php");
    } 
    $stmt = mysqli_prepare($link, $sql = "SELECT * FROM `kullanicilar` WHERE `id`=(?)");
    mysqli_stmt_bind_param($stmt, "s", $id);
	mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $username, $password,$type);
    mysqli_stmt_fetch($stmt);           
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı İşlemleril</title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form method="post" action="edit.php" role="form">
	<div class="modal-body">
		<div class="form-group">
		    <label for="id">ID</label>
		    <input type="text" class="form-control" id="id" name="id" value="<?php echo $id ;?>" readonly="true"/>
		</div>
		<div class="form-group">
		    <label for="username">Kullanıcı Adı</label>
	            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username;?>" />
		</div>
		<div class="form-group">
		    <label for="password">Şifre</label>
	            <input type="password" class="form-control" id="password" name="password" value='' />
		</div>
		<div class="form-group">
		     <label for="yetki">Yetki</label>
		     <input type="text" class="form-control" id="yetki" name="yetki" value="<?php echo $type;?>" />
		</div>
		</div>
		<div class="modal-footer">
		     <input type="submit" class="btn btn-primary" name="submit" value="Update" />&nbsp;
		     <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
		</div>
	</form>
</body>
</html>