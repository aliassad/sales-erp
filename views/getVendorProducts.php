
<?php
require("helpers.php");

$id=$_GET['id'];


$data = array();

$result= query("SELECT p.id,p.name,p.rate from vendorproducts p,vendor c where c.type=p.did and c.id='$id'");
 while($row = mysqli_fetch_array($result)){
     
      $row_data = array(
    'id' =>$row['id'],
    'name' =>$row['name'],
    'rate'=>$row['rate']      
   );
  array_push($data, $row_data);
 }

 
 echo json_encode($data);

?>
