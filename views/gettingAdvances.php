<?php
require("helpers.php");

$sdate;
$id;
 if(isset($_GET['date']))
$sdate=$_GET['date'];
else
if(isset($_GET['id']))
    $id=$_GET['id'];

if(isset($sdate))
$result=query("select ee.name,ee.id,e.advance,e.deductadvance,DATE_FORMAT(e.date,'%d-%m-%Y') as date  from employeesalary e,employee ee where e.date=STR_TO_DATE('$sdate','%d-%m-%Y') and e.eid=ee.id");
else if(isset($id))
$result=query("select ee.name,ee.id,e.advance,e.deductadvance,DATE_FORMAT(e.date,'%d-%m-%Y') as date from employeesalary e,employee ee where e.eid=ee.id and ee.id='$id'");
                              
 $data = array();
$i=1;

while($row = mysqli_fetch_array($result)){

  $row_data = array(
   'id' => $i, 
   'eid' => $row['id'], 
   'date' => $row['date'], 
   'name' => $row['name'], 
   'paid' => $row['advance'],
   'deduct' => $row['deductadvance']
   );
  array_push($data, $row_data);
    $i=$i+1;
 }
 
 echo json_encode($data);

?>