<?php
require("helpers.php");
 $result= query('SELECT * from product');
 $data = array();
 while($row = mysqli_fetch_array($result)){
  $row_data = array(
    'id' => $row['id'], 
    'des' => $row['des'],
    'stock' => $row['stock'],
    'sprice' => $row['saleprice'],
    'pprice' => $row['purchaseprice'],
    'minstock' => $row['minstock'],
    'disc' => $row['discount']
   );
  array_push($data, $row_data);
 }
 
 echo json_encode($data);

?>