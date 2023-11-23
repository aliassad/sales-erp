<?php 
require_once('helpers.php');


$cid=$_POST['cid'];
$r=query("delete from customer where id='$cid';");
if(!$r)
echo 'false';
else
echo 'true';
?>