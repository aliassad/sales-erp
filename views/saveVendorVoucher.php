<?php
require_once("helpers.php");

$id = $_POST['vid'];
$payment = $_POST['payment'];
$ptype = $_POST['ptype'];
$pdetail = $_POST['pdetail'];
$advance = $_POST['advance'];
$dadvance = $_POST['dadvance'];
$vdate = $_POST['vdate'];
$bno = $_POST['bno'];

$tableData = stripcslashes($_POST['pTableData']);


// Decode the JSON array
$tableData = json_decode($tableData, TRUE);


if ($payment > 0 || $advance > 0 || $dadvance > 0) {
    $r = query("INSERT INTO `vendorpayments` ( `vid`, `amount`, `date`, `advance`, `advancededuct`,`ptype`,`pdetail`) VALUES ('$id', '$payment',STR_TO_DATE('$vdate','%d-%m-%Y'), '$advance','$dadvance','$ptype','$pdetail');");
    if (!$r) {
        echo "false";
    }
}


for ($i = 0; $i < count($tableData); $i++) {
    $qty = $tableData[$i]['qty'];
    $amount = $tableData[$i]['amount'];
    $product = $tableData[$i]['product'];
    $rate = $tableData[$i]['rate'];

    $r = query("UPDATE product set `stock`=`stock`+'$qty' where id='$product'");
    if (!$r) {
        echo "false2";
    }

    $r = query("INSERT INTO `vendorpurchase` (`pid`,`qty`, `rate`,`amount`, `vp`, `date`,`vno`) VALUES ('$product','$qty','$rate','$amount','$id',STR_TO_DATE('$vdate','%d-%m-%Y'),'$bno');");
    if (!$r) {
        echo "false2";
    }
}

echo "true";

?>


