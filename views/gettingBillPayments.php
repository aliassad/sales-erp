
<?php
require("helpers.php");

$eid=$_GET['id'];
$result=query("select s.id,s.amount,DATE_FORMAT(s.date,'%d-%m-%Y') as date from billamounts s where bid='$eid';");                            
 $data = array();
while($row = mysqli_fetch_array($result)){

  $row_data = array(
   'id' => $row['id'], 
   'amount' => $row['amount'],
    'date' => $row['date']
   );
  array_push($data, $row_data);
 }

echo json_encode($data);
?>         
