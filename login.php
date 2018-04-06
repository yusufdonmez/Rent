
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
    <script src="js/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="js/popper.min.js" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" crossorigin="anonymous"></script>

    <title>Araç Kiralama Otomasyonu</title>
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
        </ul>
      </div>
    </nav>
    <p></br></br></br></p>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel body">
                        <?php
                        include 'config.php';
                        if( !empty($_POST['username'])  && !empty($_POST['password'])){
                            $username = $_POST['username'];
                            $password = md5($_POST['password']);                   
                            $stmt = $db->prepare("SELECT * FROM kullanicilar WHERE username=? AND password=?"); 
                            $stmt->bindParam(1,$username);
                            $stmt->bindParam(2,$password);
                            $stmt->execute();
                            $row = $stmt->fetch();
                            $user = $row['username'];
                            $pass = $row['password'];
                            $id = $row['id'];
                            $type = $row['type'];                    
                            if($user == $username && $pass == $password){
                                session_start();       
                                $_SESSION['username'] = $user;
                                $_SESSION['password'] = $pass;
                                $_SESSION['id'] = $id;
                                $_SESSION['type'] = $type;
                                ?>
                                <script>window.location.href='index.php';</script>
                                <?php
                            }else{
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                      <strong>Uyarı!</strong> Kullanıcı adı veya şifre hatalı.
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                <?php
                            }
                        
                        }
                        ?>
                        <form method="post">
                            <div class="form-group">
                                <label>Kullanıcı Adı</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="form-group">
                                <label>Şifre</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <input type="submit" value="Giriş" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
        </div>
    </div>


  </body>
</html>