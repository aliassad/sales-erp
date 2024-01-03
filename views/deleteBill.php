<?php
require_once('helpers.php');


$bid = $_POST['bid'];
$r = query("select type from bill where id='$bid'");
if (!$r)
    echo 'false';
while ($row = mysqli_fetch_array($r)) {
    $type1 = $row['type'];
}
$r = query("select * from lineitem where bid='$bid';");
$result = true;
while ($row = mysqli_fetch_array($r)) {
    $unit = $row['unit'];
    $product = $row['product'];
    if ($type1 == 'Invoice') {
        $result = query("UPDATE `product` SET `stock`=`stock`+'$unit' WHERE `id`='$product';");
    }
    if (!$result)
        echo 'false';
}

$r = query("delete from bill where id='$bid';");
if (!$r)
    echo 'false';
else
    echo 'true';
?>