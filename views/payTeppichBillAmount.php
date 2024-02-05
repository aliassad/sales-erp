<?php
require_once('helpers.php');
$id = $_POST['bid'];
$balance = $_POST['balance'];
$paid = $_POST['paid'];
$date = $_POST['date'];


$r = query("insert into teppich_clean_billamounts (`bid`, `amount`, `date`)  values ('$id','$paid','$date')");

if ($r)
    echo 'true';
else
    echo 'false';

?>