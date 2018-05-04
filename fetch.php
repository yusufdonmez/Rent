<?php
include "checkin.php";
include "config.php";
//require('./readDataConfig.php');
echo "fetch ",$_POST["query"];
if(isset($_POST["query"]))
{
  echo $_POST["query"];
 $request = filter_var(mysqli_real_escape_string($link, $_POST["query"]), FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
echo $request;
  $stmt = mysqli_prepare($link, "SELECT * FROM cars WHERE carName LIKE CONCAT ('%', ?, '%') OR plate LIKE CONCAT ('%', ?, '%')");
  mysqli_stmt_bind_param($stmt, "ss", $request,$request);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $id, $plate, $gear,$fuel,$carName,$status);

 $data =array();
 $html = '';
 $html .= '
  <table class="table table-bordered table-striped">
   <tr>
    <th>ID</th>
    <th>Plaka</th>
    <th>Vites</th>
    <th>Yakıt</th>
    <th>Adı</th>
    <th>Durumu</th>
    ';
if($_SESSION["type"] != "musteri"){
  $html .= '<th>işlemler</th>';
  }else {
  $html .= '</tr>';
}

 //if(mysqli_num_rows($result) > 0)
if(mysqli_stmt_fetch($stmt))
 {
  //while($row = mysqli_fetch_array($result))
  while (mysqli_stmt_fetch($stmt))
  {
   $data[] = $id;//$id"];
   $data[] = $plate; //$plate"];
   $data[] = $gear;  //$gear"];
   $data[] = $fuel;  //$fuel"];
   $data[] = $carName; //filter_var($carName"], FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
   $data[] = $status;  //$status"];
   $html .= '
   <tr>
    <td>'.$id.'</td>   
    <td>'.$plate.'</td>
    <td>'.$gear.'</td>
    <td>'.$fuel.'</td>
    <td>'.$carName.'</td>
    <td>'.$status.'</td>';

    if($_SESSION["type"] != "musteri"){
      $html .= '<td>
    <a href="editCar.php?id='. $id .'" title="Düzenle" data-toggle="modal" data-target="#editModal" data-whatever="'.$id.'" class="btn btn-primary btn-sm">düzenle</a>
    <a href="deleteCar.php?id='. $id .'" title="Kayıt Sil" data-toggle="tooltip" class="btn btn-danger btn-sm"> sil</a>
    </td>';
    } else{
      $html .= '</tr>';
    }
  }
 }
 else
 {
  $data = 'No Data Found';
  $html .= '
   <tr>
    <td colspan="3">No Data Found</td>
   </tr>
   ';
 }
 $html .= '</table>';
 if(isset($_POST['typehead_search']))
 {
  echo $html;
 }
 else
 {
  $data = array_unique($data);
  echo json_encode($data);
 }
}

?>