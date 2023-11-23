<?php
require('helpers.php');

$paymentMode = $_POST['payingPaymentMode'];
$vendorId = $_POST["vendorId"];

if ($paymentMode == 1) {
    $detail = $_POST["payingDetail"];
    $amount = $_POST["payingAmount"];
    $date = $_POST["paymentPayingDate"];

    $result = query("insert into vendorpayments (`vid`,`amount`,`ptype`,`pdetail`,`date`) values('$vendorId','$amount','Debit','$detail',STR_TO_DATE('$date',
'%d-%m-%Y'));");


    if (!$result)
        echo 'false';
    else
        echo "true";
} else if ($paymentMode == 3) {

    $detail = $_POST["payingDetail"];
    $amount = $_POST["payingAmount"];
    $date = $_POST["paymentPayingDate"];
    $depositSlipNo = $_POST["payingDepositSlipNo"];
    $bankId = $_POST["payingBank"];

    $result = query("insert into vendorpayments (`vid`,`amount`,`ptype`,`pdetail`,`date`) values('$vendorId','$amount','Debit','$detail',STR_TO_DATE('$date',
'%d-%m-%Y'));");
if (!$result)
    echo 'false';

    $result=query("INSERT INTO `accounttransaction` (`id`, `aid`, `discription`, `debit`, `credit`, `date`) VALUES (NULL, '$bankId', '$detail', '0','$amount',STR_TO_DATE('$date','%d-%m-%Y'));");
    if (!$result)
        echo 'false';

}


?>