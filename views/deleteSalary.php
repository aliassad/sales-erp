<?php
require('helpers.php');
$id=$_POST['sid'];



$result=query("Delete from employeesalary where id='$id'");

if(!$result)
echo 'false';
else
echo 'true';

?>