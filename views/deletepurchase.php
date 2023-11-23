<?php
include('helpers.php');

$id=$_POST['rid'];

$result=query("select * from vendorpurchase where id='$id'");
$pqty=0;
$pdis="";
while($row=mysqli_fetch_array($result))
{
    $pqty=$row['qty'];
    $pdis=$row['pid'];
}

$result=query("UPDATE product set `stock`=`stock`-'$pqty' where des='$pdis'");

$result=query("delete from vendorpurchase where id='$id'");

if($result)
    echo 'true';
else 
    echo 'false';





?>