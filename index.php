<?php
include "config.php";
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
    die();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Araç Kiralama Otomasyon</title>
  </head>
  <body>

     <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-static-top">
      <!--<a class="navbar-brand" href="#">Araç Otomasyon</a>-->
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
            <li class="nav-item"><a class="nav-link"  href="#">Kullanıcı Ekleme</a></li>
            <li class="nav-item"><a class="nav-link"  href="#">Kullanıcı Sorgulama</a></li>
            <li class="nav-item"><a  class="nav-link"  href="#">Araç Ekleme</a></li>
            <li class="nav-item"><a class="nav-link"  href="#">Araç Silme</a></li>            
            <li class="nav-item"><a  class="nav-link" href="#">Araç Düzenleme</a></li>
            <?php
            }
            ?>
            <li class="nav-item"><a class="nav-link"  href="#">Araç Sorgulama</a></li>  
        </ul>

      </div>
          <ul class="nav navbar-nav navbar-left">
              <li class="nav-item"><a class="nav-link"><?php echo $_SESSION['username'] ?></a></li>
             <li class="nav-item" ><a class="btn btn-danger" href="logout.php" role="button">ÇIKIŞ</a></li>
          </ul>
    </nav>
  <div class="container">
      <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action active">1</a>
              <a href="#" class="list-group-item list-group-item-action">2</a>
              <a href="#" class="list-group-item list-group-item-action">3</a>
              <a href="logout.php" class="list-group-item list-group-item-action">Çıkış</a>
            </div>
          </div>
          <div class="col-md-6">
              <div class="jumbotron">
                  <h1 class="display-4">Merhaba <?php echo $_SESSION['type'] ?></h1>
                  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                  <hr class="my-4">
                  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                  <p class="lead">
                    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
                  </p>
              </div>
          </div>
      </div>
  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>