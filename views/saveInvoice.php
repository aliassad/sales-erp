<?php
require_once("helpers.php");

$notes = $_POST['notes'];
$type = $_POST['type'];
$cname = $_POST['customer'];
$duedate = $_POST['duedate'];
$gtotal = $_POST['total'];
$paid = ($_POST['paid']) ?: 0;
$discount = ($_POST['discount']) ?: 0;
$balance = ($_POST['balance']) ?: 0;
$wname = $_POST['wname'];
$cno = $_POST['cno'];
$mno = $_POST['mno'];
$bdate = $_POST['bdate'];
$gst = $_POST['gst'];
$billing_company = $_POST['billing_company'];

$tableData = stripcslashes($_POST['pTableData']);


// Decode the JSON array
$tableData = json_decode($tableData, TRUE);
// now $tableData can be accessed like a PHP array
$r = query("select id from customer where concat(id,': ',name)='$cname'");

if (!$r) {
    echo "false1";
} else {
    while ($ro = mysqli_fetch_array($r)) {
        $id = $ro['id'];
    }
    if ($id == 1) {
        $r = query("insert into wicustomer values('NULL','$wname','$cno')");
    }

    $r = query("insert into `bill`(`cid`, `discount`, `amount`, `date`, `ddate`, `notes`, `type`, `gst`,`billing_company`) values('$id','$discount','$gtotal',STR_TO_DATE('$bdate','%d-%m-%Y'),STR_TO_DATE('$duedate', '%d-%m-%Y'),'$notes','$type','$gst','$billing_company')");

    if (!$r) {
        echo "false2";
    }
    $r = query("select max(id) bid from bill");
    while ($ro = mysqli_fetch_array($r)) {
        $bid = $ro['bid'];
    }

    if ($mno > 0) {
        $r = query("insert into `mentry`(`mno`, `amount`, `date`, `bid`) values('$mno','$gtotal',STR_TO_DATE('$bdate','%d-%m-%Y'),'$bid')");
    }


    if ($paid != 0) {
        $r = query("insert into `billamounts`(`bid`, `amount`, `date`) values('$bid','$paid',STR_TO_DATE('$bdate','%d-%m-%Y'));");
        if (!$r) {
            echo "false3";
        }
    }
    for ($i = 0; $i < count($tableData); $i++) {
        $s = $tableData[$i]['no'];
        $product = $tableData[$i]['product'];
        $rate = $tableData[$i]['rate'];
        $unit = $tableData[$i]['unit'];
        $disc = $tableData[$i]['disc'];
        $amount = $tableData[$i]['amount'];


        if ($type == 'Invoice') {
            query("UPDATE `product` SET `stock`=`stock`-'$unit' WHERE `id`='$product'");
        }

        query("INSERT INTO `lineitem`(`lid`, `bid`, `product`, `rate`, `unit`, `discount`, `amount`, `status`)  VALUES ('$s','$bid','$product','$rate','$unit','$disc','$amount','0')");
    }

    echo "true";
}
?>

