<?php
include "checkin.php";
include "config.php";
error_reporting(0);
//require('./readDataConfig.php');

if(isset($_POST["query"]))
{

 //$request = filter_var(mysqli_real_escape_string($link, $_POST["query"]), FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
 $request = filter_var($_POST["query"],FILTER_SANITIZE_ENCODED);
 //$request = filter_var($_POST["query"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 //$request = mysqli_real_escape_string($link, $_POST["query"]);
 $query = "
  SELECT * FROM cars 
  WHERE carName LIKE '%".$request."%' 
  OR plate LIKE '%".$request."%' 
 ";
  $result = mysqli_query($link, $query);
  //error_log ($query, 3, "log.txt");
  error_log ($request, 3, "log.txt");error_log ("\n", 3, "log.txt");
 /*
 $result = mysqli_query($link, $query);
  $stmt = mysqli_prepare($link, "SELECT * FROM cars WHERE carName LIKE CONCAT ('%', ?, '%') OR plate LIKE CONCAT ('%', ?, '%')");
  mysqli_stmt_bind_param($stmt, "ss", $request,$request);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $id, $plate, $gear,$fuel,$carName,$status);
*/
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

 if(mysqli_num_rows($result) > 0)
//if(mysqli_stmt_fetch($stmt))
 {
  while($row = mysqli_fetch_array($result))
  //while (mysqli_stmt_fetch($stmt))
  {
       $data[] = $row["id"];
   $data[] = $row["plate"];
   $data[] = $row["gear"];
   $data[] = $row["fuel"];
   $data[] = $row["carName"];
   $data[] = $row["status"];
   /*$data[] = $id;//$id"];
   $data[] = $plate; //$plate"];
   $data[] = $gear;  //$gear"];
   $data[] = $fuel;  //$fuel"];
   $data[] = $carName; //filter_var($carName"], FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
   $data[] = $status;  //$status"];*/
   /*$html .= '
   <tr>
    <td>'.$id.'</td>   
    <td>'.$plate.'</td>
    <td>'.$gear.'</td>
    <td>'.$fuel.'</td>
    <td>'.$carName.'</td>
    <td>'.$status.'</td>';*/
    $html .='
    <tr>
        <td>'.$row["id"].'</td>
    <td>'.$row["plate"].'</td>
    <td>'.$row["gear"].'</td>
    <td>'.$row["fuel"].'</td>
    <td>'.$row["carName"].'</td>
    <td>'.$row["status"].'</td>';

    if($_SESSION["type"] != "musteri"){
      $html .= '<td>
    <a href="editCar.php?id='. $row["id"] .'" title="Düzenle" data-toggle="modal" data-target="#editModal" data-whatever="'.$row["id"].'" class="btn btn-primary btn-sm">düzenle</a>
    <a href="deleteCar.php?id='. $row["id"] .'" title="Kayıt Sil" data-toggle="tooltip" class="btn btn-danger btn-sm"> sil</a>
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