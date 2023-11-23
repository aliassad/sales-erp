<?php 
require_once('helpers.php');


$bid=$_POST['bid'];
$r=query("delete from bill where id='$bid';");
if(!$r)
echo 'false';
else
echo 'true';
?>