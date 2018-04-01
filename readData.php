<?php
include "config.php";
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Araçlar</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
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
            <li class="nav-item"><a class="nav-link"  href="#">Kullanıcı Ekleme</a></li>
            <li class="nav-item"><a class="nav-link"  href="#">Kullanıcı Sorgulama</a></li>
            <li class="nav-item"><a  class="nav-link"  href="readData.php">Araç Ekleme</a></li>
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
    
        <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="memberModalLabel">Edit Member Detail</h4>
                </div>
                <div class="dash">
                 <!-- Content goes in here -->
                </div>
            </div>
        </div>
    </div>
    
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Kullanıcı Detay</h2>
                        <a href="create.php" class="btn btn-success pull-right">Yeni Kullanıcı Ekle</a>
                    </div>
                    <?php
                    // Include config file
                    require_once 'readDataConfig.php';
                    
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
                                        echo "<th>işlemler</th>";
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
                                            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='edit.php?id=". $row['id'] ."' title='Düzenle' data-toggle='modal' data-target='#exampleModal' data-whatever='".$row['id']."'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
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
     </script>
</body>
</html>