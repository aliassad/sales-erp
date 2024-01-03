<?php 
require_once('helpers.php');


$eid=$_POST['id'];
$ad=$_POST['ad'];
$dad=$_POST['dad'];

$r=query("update vendorpayments set advance='$ad',advancededuct='$dad' where id='$eid';");
if(!$r)
echo 'false';
else
echo 'true';
?>