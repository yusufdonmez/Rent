<?php
    error_reporting(0);
include "checkin.php";
include "config.php";
if($_SESSION['type'] == "musteri"){
    header("location:index.php");
    die();
}

// Include config file
//require_once 'readDataConfig.php';
 
// Define variables and initialize with empty values
$plate = $gear = $fuel = $carName = "";
$plate_err = $gear_err = $fuel_err = $carName_err =  "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $plate = filter_var($_POST["plate"],FILTER_SANITIZE_ENCODED);
    $gear = filter_var($_POST["gear"],FILTER_SANITIZE_ENCODED);
    $fuel = filter_var($_POST["fuel"],FILTER_SANITIZE_ENCODED);
    $carName = filter_var($_POST["carName"],FILTER_SANITIZE_ENCODED);
    $status = "alınabilir";
           
    // Check input errors before inserting in database
    if(empty($plate_err) && empty($gear_err) && empty($fuel_err) && empty($carName_Err)){
        // Prepare an insert statement
        $sql = "INSERT INTO cars (plate, gear, fuel, carName, status) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $plate, $gear, $fuel, $carName, $status);
                        
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: newReadCars.php");die();
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

        <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
    <script src="js/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="js/popper.min.js" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-static-top">
      <a class="navbar-brand" href="#">Araç Kiralama Otomasyonu</a>
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
            <li class="nav-item"><a class="nav-link"  href="newReadUsers.php">Kullanıcı İşlemleri</a></li>
            <?php
            }
            ?>
            <li class="nav-item"><a class="nav-link"  href="newReadCars.php">Araç İşlemleri</a></li>
        </ul>
      </div>
        <ul class="navbar-nav">          
            <li class="nav-item"><a class="nav-link"><?php echo $_SESSION['username'] ?></a></li>
            <li class="nav-item" ><a class="btn btn-danger" href="logout.php" role="button">ÇIKIŞ</a></li>
        </ul>
    </nav>

<div class="container">
      <div class="row">
          <div class="col-md-2"> </div>
          <div class="col-md-9">
              <div class="jumbotron">
                    <div class="page-header">
                        <h2>Yeni Kayıt</h2>
                    </div>
                    <p>Araç eklemek için lütfen formu doldurun.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($plate_err)) ? 'has-error' : ''; ?>">
                            <label>Plaka</label>
                            <input type="text" name="plate" class="form-control" value="<?php echo $plate; ?>" required>
                            <span class="help-block"><?php echo $plate_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($gear_err)) ? 'has-error' : ''; ?>">
                            <label>gear</label>
                            <input type="text" name="gear" class="form-control" value="<?php echo $gear; ?>"  required>
                            <span class="help-block"><?php echo $gear_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($fuel_err)) ? 'has-error' : ''; ?>">
                            <label>Yakıt</label>
                            <input type="text" name="fuel" class="form-control"  value="<?php echo $fuel; ?>"  required>
                            <span class="help-block"><?php echo $fuel_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($carName_err)) ? 'has-error' : ''; ?>">
                            <label>Araç Adı</label>
                            <input type="text" name="carName" class="form-control"  value="<?php echo $carName; ?>"  required>
                            <span class="help-block"><?php echo $carName_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Ekle">
                            <a href="newReadCars.php" class="btn btn-default">İptal</a>
                    </form>
            </div>
        </div>        
    </div>
</div>
</body>
</html>