<?php
	include "config.php";
    //require('./readDataConfig.php');
    $id = $_GET['id'];

    if (isset($_POST['submit'])) {
    	$id = filter_var($_POST['id'],FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
    	$plate = filter_var($_POST['plate'],FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
    	$gear = filter_var($_POST['gear'],FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
    	$fuel = filter_var($_POST['fuel'],FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
    	$carName = filter_var($_POST['carName'],FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
    	$status = filter_var($_POST['status'],FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
    	
    	$stmt = mysqli_prepare($link, "UPDATE cars SET plate = ?, gear = ?, fuel=?, carName=?, status=? WHERE id=?");
    	mysqli_stmt_bind_param($stmt, "ssssss", $plate,$gear,$fuel, $carName, $status,$id);
    	mysqli_stmt_execute($stmt);
            
    	header("location:newReadCars.php");
    }
    $stmt = mysqli_prepare($link, "SELECT * FROM `cars` WHERE `id`=?");
    mysqli_stmt_bind_param($stmt, "s", $id);
	mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $plate, $gear,$fuel,$carName,$status);
    mysqli_stmt_fetch($stmt);      
?>

<!DOCtype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Araç İşlemleri</title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form method="post" action="editCar.php" role="form">
	<div class="modal-body">
		<div class="form-group">
		    <label for="id">ID</label>
		    <input type="text" class="form-control" id="id" name="id" value="<?php echo $id;?>" readonly="true"/>
		</div>
		<div class="form-group">
		    <label for="plate">Plaka</label>
	            <input type="text" class="form-control" id="plate" name="plate" value="<?php echo $plate;?>" />
		</div>
		<div class="form-group">
		    <label for="gear">Vites</label>
	            <input type="gear" class="form-control" id="gear" name="gear" value="<?php echo $gear;?>" />
		</div>
		<div class="form-group">
		     <label for="fuel">Yakıt</label>
		     <input type="text" class="form-control" id="fuel" name="fuel" value="<?php echo $fuel;?>" />
		</div>
		<div class="form-group">
		     <label for="carName">Araç Adı</label>
		     <input type="text" class="form-control" id="carName" name="carName" value="<?php echo $carName;?>" />
		</div>
		<div class="form-group">
		     <label for="status">Durumu</label>
		     <input type="text" class="form-control" id="status" name="status" value="<?php echo $status;?>" />
		</div>
		</div>
		<div class="modal-footer">
		     <input type="submit" class="btn btn-primary" name="submit" value="Update" />&nbsp;
		     <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
		</div>
	</form>
</body>
</html>