<?php
    require('./readDataConfig.php');
    $id = $_GET['id'];

    if (isset($_POST['submit'])) {
    	$id = $_POST['id'];
    	$plate = $_POST['plate'];
    	$gear = $_POST['gear'];
    	$fuel = $_POST['fuel'];
    	$carName = $_POST['carName'];
    	$status = $_POST['status'];
    
        $sql = ("UPDATE cars SET plate = '".$plate."', gear = '".$gear."', fuel = '".$fuel."', carName = '".$carName."', status = '".$status."' WHERE id ='".$id."'");
        $result = mysqli_query($link, $sql);
        //echo $sql."--".$result;
            
    	header("location:newReadCars.php");
    }
    $sql = "SELECT * FROM `cars` WHERE `id`=".$id;
    $result = mysqli_query($link, $sql);
    $mem = mysqli_fetch_array($result);       
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
		    <input type="text" class="form-control" id="id" name="id" value="<?php echo $mem['id'];?>" readonly="true"/>
		</div>
		<div class="form-group">
		    <label for="plate">Plaka</label>
	            <input type="text" class="form-control" id="plate" name="plate" value="<?php echo $mem['plate'];?>" />
		</div>
		<div class="form-group">
		    <label for="gear">Vites</label>
	            <input type="gear" class="form-control" id="gear" name="gear" value="<?php echo $mem['gear'];?>" />
		</div>
		<div class="form-group">
		     <label for="fuel">Yakıt</label>
		     <input type="text" class="form-control" id="fuel" name="fuel" value="<?php echo $mem['fuel'];?>" />
		</div>
		<div class="form-group">
		     <label for="carName">Araç Adı</label>
		     <input type="text" class="form-control" id="carName" name="carName" value="<?php echo $mem['carName'];?>" />
		</div>
		<div class="form-group">
		     <label for="status">Durumu</label>
		     <input type="text" class="form-control" id="status" name="status" value="<?php echo $mem['status'];?>" />
		</div>
		</div>
		<div class="modal-footer">
		     <input type="submit" class="btn btn-primary" name="submit" value="Update" />&nbsp;
		     <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
		</div>
	</form>
</body>
</html>