<?php
include_once('helpers.php');

$billno=$_POST['billid'];
$r=query("Delete from lineitem where bid='$billno';");
sleep(2);
if($r)
    echo 'true';
else 
    echo 'false';

?>