<?php
require("helpers.php");

$aid=$_GET['id'];
 $result =query("SELECT t.id,t.discription as dis,t.debit,t.credit,DATE_FORMAT(t.date, '%d-%m-%Y') as date from accounttransaction t WHERE  t.aid='$aid'");
 $data = array();
 while($row = mysqli_fetch_array($result)){
  $row_data = array(
   'id' => $row['id'], 
   'dis' => $row['dis'],
    'debit' => $row['debit'],
    'credit' => $row['credit'],
    'date' => $row['date']
   );
  array_push($data, $row_data);
 }

echo json_encode($data);
?>