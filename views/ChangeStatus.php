<?php
require("helpers.php");
 
$id=$_POST['rid'];
$status=$_POST['st'];
 $result=query("Update lineitem set status='$status' where id='$id'");
   
     if($result)
    echo 'true';
    else 
    echo 'false';    

?>