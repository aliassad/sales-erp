<?php 
include('helpers.php');
$eid=$_GET['mid'];
$padvance=0;
$pwadvance=0;
$limit=0;
$result=query("select sum(advance-deductadvance) as padvance from employeesalary e where e.eid='$eid'");
while($row=mysqli_fetch_array($result))
{
    $padvance=$row['padvance'];
}
$result=query("select sum(weekadvance-deductweekadvance) as wpadvance from employeesalary e where e.eid='$eid'");
while($row=mysqli_fetch_array($result))
{
    $pwadvance=$row['wpadvance'];
}


$result=query("select advancelimit  from employee  e where e.id='$eid'");
while($row=mysqli_fetch_array($result))
{
    $limit=$row['advancelimit'];
}




 $data = array();
  $row_data = array('padvance' => $padvance, 'wadvance' => $pwadvance,'limit' => $limit );
array_push($data,$row_data);

 echo json_encode($data);




?>