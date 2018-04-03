<?php
    require('./readDataConfig.php');
    $id = $_GET['id'];

    if (isset($_POST['submit'])) {
    	$id = $_POST['id'];
    	$plate = $_POST['plate'];
    	$vites = $_POST['vites'];
    	$fuel = $_POST['fuel'];
    	$carName = $_POST['carName'];
    	$durum = $_POST['durum'];
    
        $sql = ("UPDATE cars SET plate = '".$plate."', vites = '".$vites."', fuel = '".$fuel."', carName = '".$carName."', durum = '".$durum."' WHERE id ='".$id."'");
        $result = mysqli_query($link, $sql);
        //echo $sql."--".$result;
            
    	header("location:readCars.php");
    }
    $sql = "SELECT * FROM `cars` WHERE `id`=".$id;
    $result = mysqli_query($link, $sql);
    $mem = mysqli_fetch_array($result);
            
    //$members = $mysqli->query("SELECT * FROM `kullanicilar` WHERE `id`='$id'");
    //$mem = mysqli_fetch_assoc($members);
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
		    <label for="vites">Vites</label>
	            <input type="vites" class="form-control" id="vites" name="vites" value=''/>
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
		     <label for="durum">Durumu</label>
		     <input type="text" class="form-control" id="durum" name="durum" value="<?php echo $mem['durum'];?>" />
		</div>
		</div>
		<div class="modal-footer">
		     <input type="submit" class="btn btn-primary" name="submit" value="Update" />&nbsp;
		     <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
		</div>
	</form>
</body>
</html>