<?php
require("helpers.php");
 
$id=$_GET['id'];


$result=query("select DATE_FORMAT(e.date,'%d-%m-%Y') as date,e.advance,e.deductadvance from employeesalary e where  e.eid='$id'");
                              
 $data = array();
$i=1;

while($row = mysqli_fetch_array($result)){

  $row_data = array(
   'id' => $i, 
   'date' => $row['date'], 
   'paid' => $row['advance'],
   'deduct' => $row['deductadvance']
   );
  array_push($data, $row_data);
    $i=$i+1;
 }
 
 echo json_encode($data);

?>