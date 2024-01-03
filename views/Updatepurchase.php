<?php
include('helpers.php');

$id=$_POST['pid'];
$name=$_POST['pname'];
$rate=$_POST['prate'];
$unit=$_POST['punit'];


$result=query("select * from vendorpurchase where id='$id'");
$pqty=0;
$pdis="";
while($row=mysqli_fetch_array($result))
{
    $pqty=$row['qty'];
    $pdis=$row['pid'];
}

$result=query("UPDATE product set `stock`=`stock`-'$pqty' where des='$pdis'");
$result=query("update vendorpurchase set pid='$name',qty='$unit',rate='$rate' where id='$id'");
$result=query("UPDATE product set `stock`=`stock`+'$unit' where des='$name'");

if($result)
    echo 'true';
else
    echo 'false';





?>