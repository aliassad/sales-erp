<?php
require("helpers.php");

$vid=$_GET['id'];
 $result =query("SELECT p.id,p.pid,p.qty,p.rate,DATE_FORMAT(p.date, '%d-%m-%Y') as date from vendorpurchase p WHERE  p.vp='$vid'");
 $data = array();
 while($row = mysqli_fetch_array($result)){
  $row_data = array(
   'id' => $row['id'], 
   'product' => $row['pid'], 
    'unit' => $row['qty'],
    'rate' => $row['rate'],
    'date' => $row['date']
   );
  array_push($data, $row_data);
 }

echo json_encode($data);
?>