<?php
    require('./readDataConfig.php');
    $id = $_GET['id'];

    if (isset($_POST['submit'])) {
    	$id = $_POST['id'];
    	$username = $_POST['username'];
    	$password = $_POST['password'];
    	$yetki = $_POST['yetki'];
    
        $sql = ("UPDATE 'kullanicilar' SET 'username' = ".$username.", `password` = ".md5($password).", `type`=".$yetki." WHERE `id`=".$id);
        $result = mysqli_query($link, $sql);
        echo $sql."--".$result;
            
    	//header("location:index.php");
    }
    $sql = "SELECT * FROM `kullanicilar` WHERE `id`=".$id;
    $result = mysqli_query($link, $sql);
    $mem = mysqli_fetch_array($result);
            
    //$members = $mysqli->query("SELECT * FROM `kullanicilar` WHERE `id`='$id'");
    //$mem = mysqli_fetch_assoc($members);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using Bootstrap modal</title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form method="post" action="edit.php" role="form">
	<div class="modal-body">
		<div class="form-group">
		    <label for="id">ID</label>
		    <input type="text" class="form-control" id="id" name="id" value="<?php echo $mem['id'];?>" readonly="true"/>
		</div>
		<div class="form-group">
		    <label for="username">Kullanıcı Adı</label>
	            <input type="text" class="form-control" id="username" name="username" value="<?php echo $mem['username'];?>" />
		</div>
		<div class="form-group">
		    <label for="password">Şifre</label>
	            <input type="password" class="form-control" id="password" name="password" value=''/>
		</div>
		<div class="form-group">
		     <label for="yetki">Yetki</label>
		     <input type="text" class="form-control" id="yetki" name="yetki" value="<?php echo $mem['type'];?>" />
		</div>
		</div>
		<div class="modal-footer">
		     <input type="submit" class="btn btn-primary" name="submit" value="Update" />&nbsp;
		     <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
		</div>
	</form>
</body>
</html>