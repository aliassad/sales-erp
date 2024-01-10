<?php
include_once('helpers.php');


$notes = $_POST['notes'];
$type = $_POST['type'];
$cname = $_POST['customer'];
$bid = $_POST['billid'];
$duedate = $_POST['duedate'];
$date = $_POST['ndate'];
$gtotal = $_POST['total'];
$paid = $_POST['paid'];
$discount = $_POST['discount'];
$balance = $_POST['balance'];
$gst = $_POST['gst'];
$billing_company = $_POST['billing_company'];
$bill_serial = $_POST['bill_serial'];


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

$r = query("Delete from lineitem where bid='$bid';");
if (!$r)
    echo 'false';


$tableData = stripcslashes($_POST['pTableData']);
// Decode the JSON array<br>
$tableData = json_decode($tableData, TRUE);
// now $tableData can be accessed like a PHP array
$id = getCustomerId($cname);
if ($id) {

    $r = query("UPDATE  bill SET `bill_serial`='$bill_serial' ,`billing_company`='$billing_company',`gst`='$gst',`cid`='$id',`discount`='$discount',`amount`='$gtotal',date=STR_TO_DATE('$date', '%d-%m-%Y'),ddate=STR_TO_DATE('$duedate', '%d-%m-%Y'),notes='$notes',type='$type' where id='$bid'");
    if (!$r) {
        echo "false1";
    }


    for ($i = 0; $i < count($tableData); $i = $i + 1) {

        $s = $tableData[$i]['no'];
        $product = $tableData[$i]['product'];
        $rate = $tableData[$i]['rate'];
        $unit = $tableData[$i]['unit'];
        $disc = $tableData[$i]['disc'];
        $amount = $tableData[$i]['amount'];
        if ($type == 'Invoice') {
            $result = query("UPDATE `product` SET `stock`=`stock`-'$unit' WHERE `id`='$product'");
            if (!$result) {
                echo "false2";
                break;
            }
        }

        $result = query("INSERT INTO lineitem VALUES(NULL,'$s','$bid','$product','$rate','$unit','$disc','$amount','0');");

    }


    echo 'true';

}


?>