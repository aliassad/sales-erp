<?php
require('helpers.php');

$id=$_GET['id'];



$result=query("select concat('(',a.id,') ',a.code,': ',ac.typename) as name,t.discription,t.debit,t.credit,t.id from account a,accounttypes ac,accounttransaction t where a.type=ac.id and t.aid=a.id and t.id='$id'");

 $data = array();
 while($row = mysqli_fetch_array($result)){
  $row_data = array(
   'name' => $row['name'], 
   'id' => $row['id'], 
   'dis' => $row['discription'],
    'debit' => $row['debit'],
    'credit' => $row['credit']
   );
  array_push($data, $row_data);
 }



echo json_encode($data);



?>