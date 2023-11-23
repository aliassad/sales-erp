<?php
require("helpers.php");

$eid=$_GET['id'];

$result=query("select e.id,e.advance,e.advancededuct,DATE_FORMAT(e.date, '%d-%m-%Y') as date from vendorpayments e where vid='$eid';");
                              
 $data = array();
while($row = mysqli_fetch_array($result)){
       
                       
  $row_data = array(
   'id' => $row['id'], 
   'advancepaid' => $row['advance'],
   'advancededuct' => $row['advancededuct'],
    'date' => $row['date']
   );
  array_push($data, $row_data);
 }

echo json_encode($data);
?>