<?php 
require_once('helpers.php');


$eid=$_POST['rid'];

$r=query("delete from billamounts where id='$eid';");
if(!$r)
echo 'false';
else
echo 'true';
?>