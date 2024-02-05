<?php
require_once('helpers.php');


$bid = $_POST['bid'];

$r = query("delete from teppich_clean_line_item where bid='$bid';");
$r = query("delete from teppich_clean_bill where id='$bid';");
if (!$r)
    echo 'false';
else
    echo 'true';
?>