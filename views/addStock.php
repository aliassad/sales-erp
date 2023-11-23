<?php

include('helpers.php');

$id=$_POST['id'];
$stock=$_POST['stock'];

$result=query("Update product set stock=stock+'$stock' where id='$id'");
if($result)
    echo 'true';
else
    echo 'false';

?>