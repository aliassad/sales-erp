<?php
require("helpers.php");
 $result= query('SELECT * from accounttypes');
 $data = array();
 while($row = mysqli_fetch_array($result)){
  $row_data = array(
    'id' => $row['id'],
    'type' => $row['typename']  
   );
  array_push($data, $row_data);
 }
 
 echo json_encode($data);

?>