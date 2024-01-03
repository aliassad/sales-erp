<?php
require("helpers.php");
 $result= query('SELECT * from accountcurrency');
 $data = array();
 while($row = mysqli_fetch_array($result)){
  $row_data = array(
    'id' => $row['id'],
    'code' => $row['code']  
   );
  array_push($data, $row_data);
 }
 
 echo json_encode($data);

?>