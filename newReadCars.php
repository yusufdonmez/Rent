<?php
include "checkin.php";
include "config.php";
?>

<!DOCTYPE html>
<html>
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

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap3-typeahead.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
 
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
                <h2>Araç Detayları</h2>
                <?php
                if($_SESSION['type'] !== 'musteri'){
                ?>
                    <a href="createCar.php" class="btn btn-success">Yeni Araç Ekle</a>    
                <?php
                }
                ?>
                <hr class="my-4">
                <label>Araç detaylarını arayın</label>
                <div id="search_area">
                  <input type="text" name="car_search" id="car_search" class="form-control input-lg" autocomplete="off" placeholder="araç ismi yazın" />
               </div>
               <div id="car_data"></div>
              </div>
          </div>
      </div>
  </div>
 </body>
</html>

   <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
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

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
    <script src="js/3.3.7.bootstrap.min.js" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
 
 load_data('');
 
 function load_data(query, typehead_search = 'yes')
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{query:query, typehead_search:typehead_search},
   success:function(data)
   {
    $('#car_data').html(data);
   }
  });
 }
 
 $('#car_search').typeahead({
  source: function(query, result){
   $.ajax({
    url:"fetch.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data){
     result($.map(data, function(item){
      return item;
     }));
     load_data(query, 'yes');
    }
   });
  }
 });
 
 $(document).on('click', 'li', function(){
  var query = $(this).text();
  load_data(query);
 });
 
});

function escapeHtml(str) {
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(str));
    return div.innerText;
}

$('#editModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) // Button that triggered the modal
              var recipient = button.data('whatever') // Extract info from data-* attributes
              var modal = $(this);
              var dataString = 'id=' + recipient;

                $.ajax({
                    type: "GET",
                    url: "editCar.php",
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
