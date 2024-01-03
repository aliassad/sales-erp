<?php
require('helpers.php');

$id=$_GET['id'];



$result=query("select vp.id,p.des as name,vp.dis,vp.rate,vp.qty from vendorpurchase vp,product p where vp.pid=p.id and  vp.id='$id'");

 $data = array();
 while($row = mysqli_fetch_array($result)){
  $row_data = array(
   'name' => $row['name'], 
   'id' => $row['id'], 
   'dis' => $row['dis'],
    'rate' => $row['rate'],
    'qty' => $row['qty']
   );
  array_push($data, $row_data);
 }



echo json_encode($data);



?>