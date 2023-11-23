<?php

include_once('helpers.php');

$billno=$_POST['billid'];
$r=query("select type from bill where id='$billno'");
if(!$r)
echo 'false';
while($row=mysqli_fetch_array($r))
{
$type=$row['type'];
}
$r=query("select * from lineitem where bid='$billno';");
$result=true;
while($row=mysqli_fetch_array($r))
{
     $unit=$row['unit'];
     $product=$row['product'];
	 if($type=='Invoice')
					{
     $result=query("UPDATE `product` SET `stock`=`stock`+'$unit' WHERE `des`='$product';");
					}
	 if(!$result)
     echo 'false'; 
}


  
  echo 'true';



?>