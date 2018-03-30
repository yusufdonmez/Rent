
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>