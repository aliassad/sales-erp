<?php
require("helpers.php");
$i=1;

 $result =query("SELECT sum(t.debit),sum(t.credit),a.code,a.openingbalance from accounttransaction t,account a WHERE t.aid=a.id and a.type=2 GROUP By a.code ");
 $data = array();
 while($row = mysqli_fetch_array($result)){
  $row_data = array(
   'id' => $i, 
   'acno' => $row['code'],
    'debit' => $row['sum(t.debit)'],
    'credit' => $row['sum(t.credit)'],
    'obalance' => $row['openingbalance']
   );
  array_push($data, $row_data);
     $i=$i+1;
 }

echo json_encode($data);
?>