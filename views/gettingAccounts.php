<?php
require("helpers.php");
 $result= query('SELECT a.id,a.code, (select at.typename from accounttypes at where a.type=at.id or at.id is null ) as typename,ac.code as cc from account a,accountcurrency ac where a.currency=ac.id');
 $data = array();
 while($row = mysqli_fetch_array($result)){
  $row_data = array(
    'id' => $row['id'], 
    'acode' => $row['code'], 
    'atype' => $row['typename'],
    'acurrency' => $row['cc']
   );
  array_push($data, $row_data);
 }
 
 echo json_encode($data);

?>