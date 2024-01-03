<?php
require('helpers.php');

$paymentMode = $_POST['receivingPaymentMode'];
$customerId = $_POST["customerId"];

$result = query("select * from customer where id ='$customerId'");
$name = "";
while ($row = mysqli_fetch_array($result)) {
    $name = $row['name'];
}

if ($paymentMode == 1) {
    $detail = $_POST["receivingDetail"];
    $amount = $_POST["receivingAmount"];
    $type = $_POST["receivingPaymentType"];
    $date = $_POST["paymentReceivingDate"];

    $result = query("insert into customerpayments (`cid`,`amount`,`ptype`,`pdetail`,`date`) values('$customerId','$amount','$type','$detail',STR_TO_DATE
    ('$date',
'%d-%m-%Y'));");

    if (!$result)
        echo 'false';
    else
        echo 'true';
} else if ($paymentMode == 3) {
    $detail = 'Credit Card# '.$_POST["receivingChequeNo"].' '.$_POST["receivingDetail"];
    $amount = $_POST["receivingAmount"];
    $type = "Credit";
    $date = $_POST["paymentReceivingDate"];

    $result = query("insert into customerpayments (`cid`,`amount`,`ptype`,`pdetail`,`date`) values('$customerId','$amount','$type','$detail',STR_TO_DATE
    ('$date',
'%d-%m-%Y'));");

    if (!$result)
        echo 'false';
    else
        echo 'true';
} else if ($paymentMode == 2) {

    $detail = $_POST["receivingDetail"];
    $amount = $_POST["receivingAmount"];
    $date = $_POST["paymentReceivingDate"];
    $type = "Credit";
    $depositSlipNo = $_POST["receivingDepositSlipNo"];
    $bankId = $_POST["receivingBank"];

    $result = query("insert into customerpayments (`cid`,`amount`,`ptype`,`pdetail`,`date`) values('$customerId','$amount','$type','$detail',STR_TO_DATE
    ('$date','%d-%m-%Y'));");
    if (!$result)
        echo 'false';

    if ($type == "Credit") {

        $detail = "Customer Name: " . $name . " Deposit Slip: " . $depositSlipNo . " Detail: " . $detail;

        $result = query("INSERT INTO `accounttransaction` (`id`, `aid`, `discription`, `debit`, `credit`, `date`) VALUES (NULL, '$bankId', '$detail', '$amount','0',STR_TO_DATE('$date','%d-%m-%Y'));");
        if (!$result)
            echo 'false';
    }
    echo 'true';
}


?>