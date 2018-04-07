<?php
include "checkin.php";
include "config.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
    <script src="js/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="js/popper.min.js" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" crossorigin="anonymous"></script>

    <title>Araç Kiralama Otomasyonu</title>
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
              	<h2>Kullanıcı Detayları</h2>
              	<a href="create.php" class="btn btn-success">Yeni Kullanıcı Ekle</a>
                <hr class="my-4">

                <?php
                    // Include config file
                    //require_once 'readDataConfig.php';
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM kullanicilar";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>id</th>";
                                        echo "<th>Kullanıcı Adı</th>";
                                        echo "<th>Şifre</th>";
                                        echo "<th>Yetki</th>";
                                        echo "<th>İşlemler</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['username'] . "</td>";
                                        echo "<td>" . $row['password'] . "</td>";
                                        echo "<td>" . $row['type'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='edit.php?id=". $row['id'] ."' title='Düzenle' data-toggle='modal' data-target='#editModal' data-whatever='".$row['id']."' class='btn btn-primary btn-sm'>düzenle</a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Kayıt Sil' data-toggle='tooltip' class='btn btn-danger btn-sm'> sil</a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>

              </div>
          </div>
      </div>      
  </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Kapat</span></button>
                    <h4 class="modal-title" id="memberModalLabel">Kullanıcı Detaylarını Düzelt</h4>
                </div>
                <div class="dash">
                 <!-- Content goes in here -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <script>
        $('#editModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) // Button that triggered the modal
              var recipient = button.data('whatever') // Extract info from data-* attributes
              var modal = $(this);
              var dataString = 'id=' + recipient;

                $.ajax({
                    type: "GET",
                    url: "edit.php",
                    data: dataString,
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        modal.find('.dash').html(data);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });  
        }) 
        $('#editModal').on('hidden.bs.modal', function () {
         location.reload();
     })
     </script>

  </body>
</html>