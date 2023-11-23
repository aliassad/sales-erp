<?php

include('helpers.php');

$id=$_POST['id'];

$result=query("delete from contractorproducts  where id='$id'");
if($result)
    echo 'true';
else
    echo 'false';

?>