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
$username = $password = $type = "";
$username_err = $password_err = $type_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    $input_username = trim($_POST["username"]);
    if(empty($input_username)){
        $username_err = "Lütfen bir kullanıcı adı girin.";
    } else{
        $username = $input_username;
    }
    
    // Validate password
    $input_password = trim($_POST["password"]);
    if(empty($input_password)){
        $password_err = 'Please enter an password.';     
    } else{
        $password = md5($input_password);
    }
    
    // Validate type
    $input_type = trim($_POST["type"]);
    if(empty($input_type)){
        $type_err = "Please enter the type";     
    } else{
        $type = $input_type;
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($type_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO kullanicilar (username, password, type) VALUES (?, ?, ?)";
         echo "sql olustu";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_type);
            
            // Set parameters
            $param_username = $username;
            $param_password = md5($password);
            $param_type = $type;
            echo "parametreler alındı.";
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: readData.php");die();
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
                    <p>Kullanıcı eklemek için lütfen formu doldurun.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($username)) ? 'has-error' : ''; ?>">
                            <label>Kullanıcı Adı</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            <span class="help-block"><?php echo $username_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Şifre</label>
                            <input type="password" name="password" class="form-control" >
                            <span class="help-block"><?php echo $password_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($type_err)) ? 'has-error' : ''; ?>">
                            <label>Yetki</label>
                            <input type="text" name="type" class="form-control"  value="<?php echo $type; ?>">
                            <span class="help-block"><?php echo $type_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Ekle">
                            <a href="readData.php" class="btn btn-default">İptal</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>