<?php
include "config.php";
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
    die();
}
// Include config file
require_once 'readDataConfig.php';
 
// Define variables and initialize with empty values
$plate = $vites = $fuel = $carName = "";
$plate_err = $vites_err = $fuel_err = $carName_err =  "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $plate = trim($_POST["plate"]);
    $vites = trim($_POST["vites"]);
    $fuel = trim($_POST["fuel"]);
    $carName = trim($_POST["carName"]);

           
    // Check input errors before inserting in database
    if(empty($plate_err) && empty($vites_err) && empty($fuel_err) && empty($carName_Err)){
        // Prepare an insert statement
        $sql = "INSERT INTO cars (plate, vites, fuel, carName, durum) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_plate, $param_vites, $param_fuel, $param_carName, $param_durum);
            
            // Set parameters
            $param_plate = $plate;
            $param_vites= $vites;
            $param_fuel = $fuel;
            $param_carName = $carName;
            $param_durum = "alınabilir";
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: readCars.php");die();
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Yeni Kayıt Oluştur</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-static-top">
      <a class="navbar-brand" href="#">Araç Otomasyon</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
              <a class="nav-link" href="index.php">Anasayfa <span class="sr-only">(current)</span></a>
          </li>
            <?php
            if($_SESSION['type'] == 'yonetici'){
            ?>
            <li class="nav-item"><a class="nav-link"  href="readUsers.php">Kullanıcı İşlemleri</a></li>
            <?php
            }
            ?>
            <li class="nav-item"><a class="nav-link"  href="readCars.php">Araç İşlemleri</a></li>
        </ul>

      </div>
          <ul class="nav navbar-nav navbar-left">
              <li class="nav-item"><a class="nav-link"><?php echo $_SESSION['username'] ?></a></li>
             <li class="nav-item" ><a class="btn btn-danger" href="logout.php" role="button">ÇIKIŞ</a></li>
          </ul>
    </nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Yeni Kayıt</h2>
                    </div>
                    <p>Araç eklemek için lütfen formu doldurun.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($plate_err)) ? 'has-error' : ''; ?>">
                            <label>Plaka</label>
                            <input type="text" name="plate" class="form-control" value="<?php echo $plate; ?>">
                            <span class="help-block"><?php echo $plate_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($vites_err)) ? 'has-error' : ''; ?>">
                            <label>Vites</label>
                            <input type="text" name="vites" class="form-control" value="<?php echo $vites; ?>">
                            <span class="help-block"><?php echo $vites_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($fuel_err)) ? 'has-error' : ''; ?>">
                            <label>Yakıt</label>
                            <input type="text" name="fuel" class="form-control"  value="<?php echo $fuel; ?>">
                            <span class="help-block"><?php echo $fuel_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($carName_err)) ? 'has-error' : ''; ?>">
                            <label>Araç Adı</label>
                            <input type="text" name="carName" class="form-control"  value="<?php echo $carName; ?>">
                            <span class="help-block"><?php echo $carName_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Ekle">
                            <a href="readCars.php" class="btn btn-default">İptal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>