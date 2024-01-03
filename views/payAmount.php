<?php
require('helpers.php');


$paymentMode = $_POST['payingPaymentMode'];
$vendorId = $_POST["vendorId"];


$result = query("select * from vendor where id ='$vendorId'");
$name = "";
while ($row = mysqli_fetch_array($result)) {
    $name = $row['name'];
}

if ($paymentMode == 1 && isset($_POST["payingPaymentType"])) {
    $detail = $_POST["payingDetail"];
    $amount = $_POST["payingAmount"];
    $date = $_POST["paymentPayingDate"];
    $type = $_POST["payingPaymentType"];

    $result = query("insert into vendorpayments (`vid`,`amount`,`ptype`,`pdetail`,`date`) values('$vendorId','$amount','$type','$detail',STR_TO_DATE('$date',
'%d-%m-%Y'));");


    if (!$result)
        echo 'false';
    else
        echo 'true';
} else if ($paymentMode == 3) {
    $detail = 'CREDIT CARD# '.$_POST['payingChequeNo'].' '.$_POST["payingDetail"];
    $amount = $_POST["payingAmount"];
    $date = $_POST["paymentPayingDate"];
    $type = "Debit";

    $result = query("insert into vendorpayments (`vid`,`amount`,`ptype`,`pdetail`,`date`) values('$vendorId','$amount','$type','$detail',STR_TO_DATE('$date',
'%d-%m-%Y'));");
    if (!$result)
        echo 'false';
    else
        echo 'true';
} else if ($paymentMode == 2) {

    $detail = $_POST["payingDetail"];
    $amount = $_POST["payingAmount"];
    $date = $_POST["paymentPayingDate"];
    $type = "Debit";
    $depositSlipNo = $_POST["payingDepositSlipNo"];
    $bankId = $_POST["payingBank"];

    $result = query("insert into vendorpayments (`vid`,`amount`,`ptype`,`pdetail`,`date`) values('$vendorId','$amount','$type','$detail',STR_TO_DATE('$date',
'%d-%m-%Y'));");
    if (!$result)
        echo 'false';

    if ($type == "Debit") {
        $detail = "Vendor Name: " . $name . " Deposit Slip: " . $depositSlipNo . " Detail: " . $detail;

        $result = query("INSERT INTO `accounttransaction` (`id`, `aid`, `discription`, `debit`, `credit`, `date`) VALUES (NULL, '$bankId', '$detail', '0','$amount',STR_TO_DATE('$date','%d-%m-%Y'));");
        if (!$result)
            echo 'false';
    }

    echo 'true';
}


?>