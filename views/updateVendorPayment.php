<?php
require_once('helpers.php');


$eid=$_POST['id'];
$amount=$_POST['amount'];
$type=$_POST['type'];
$detail=$_POST['detail'];
$r=query("update vendorpayments set amount='$amount',ptype='$type',pdetail='$detail' where id='$eid';");
if(!$r)
    echo 'false';
else
    echo 'true';

?>