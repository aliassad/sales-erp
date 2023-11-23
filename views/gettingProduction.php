<?php
require("helpers.php");

 $result =query("SELECT b.notes,b.id,l.id as item,concat(c.id,': ',c.name) as name,DATE_FORMAT(b.date,'%d-%m-%Y') as date,l.product,l.product,l.unit,l.status from bill b,customer c,lineitem l WHERE b.cid=c.id and b.id=l.bid and b.type='Order' group by l.id ORDER BY `l`.`status` ASC");

 $data = array();
 while($row = mysqli_fetch_array($result)){
  $row_data = array(
   'id' => $row['id'],
   'notes' => $row['notes'],
   'iid' => $row['item'],
   'name' => $row['name'],
    'date' => $row['date'],
    'product' => $row['product'],
    'des' => $row['product'],
    'unit' => $row['unit'],
    'status' => $row['status']
   );
  array_push($data, $row_data);
 }


echo json_encode($data);
?>