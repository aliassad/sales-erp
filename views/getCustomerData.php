<?php
require("helpers.php");

$id = $_GET['id'];

$data = array();
$opening_balance = 0;
$amountReceived = 0;
$MoreCharge = 0;
$result = query("select * from customer where id='$id'");
while ($row = mysqli_fetch_array($result)) {
    $opening_balance = ($row['openingbalance']);
}


$result = query("select sum(amount) as amountReceived from customerpayments where cid='$id' and ptype='Credit'");
while ($row = mysqli_fetch_array($result)) {
    $amountReceived = ($row['amountReceived']);
}
$result = query("select sum(amount) as MoreCharge from customerpayments where cid='$id' and ptype='Debit'");
while ($row = mysqli_fetch_array($result)) {
    $MoreCharge = ($row['MoreCharge']);
}



$result = query("Select (SELECT sum(ba.amount) from billamounts ba,bill b WHERE ba.bid=b.id and b.cid='$id' ) tpaid,sum(amount-discount) tamount  from bill b where b.type='Invoice' and b.cid='$id'");
if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        $tamount = ($row['tamount']);
        $tpaid = ($row['tpaid']);

    }
    $tbalance = $tamount - $tpaid + $opening_balance-$amountReceived+$MoreCharge;

} else {
    $tamount = 0;
    $tpaid = 0;
    $tbalance = 0;
}


$row_data = array(
    'ppayment' => $tbalance
);
array_push($data, $row_data);
echo json_encode($data);

?>
