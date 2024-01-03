
<?php
require("helpers.php");

$id=$_GET['id'];

$paid=0;
$incentive=0;
$total=0;
$padvance=0;
$openingBalance=0;

$data = array();
$result= query("SELECT * FROM `vendor`  WHERE id='$id'");

if($result) {
 while ($row = mysqli_fetch_array($result)) {

     $openingBalance = $row['openingbalance'];

 }
}


$result= query("SELECT sum(qty*rate) as payment FROM `vendorpurchase` vp WHERE vp.vp='$id'");

if($result) {
 while ($row = mysqli_fetch_array($result)) {

  $total = $row['payment'];

 }
}
$result= query("Select sum(vp.amount) amount  FROM `vendorpayments` vp WHERE  vp.vid='$id' and vp.ptype='Debit'");
if($result) {
 while ($row = mysqli_fetch_array($result)) {
  $paid = ($row['amount']);
 }
}

$result= query("Select sum(vp.amount) amount  FROM `vendorpayments` vp WHERE  vp.vid='$id' and vp.ptype='Credit'");
if($result) {
 while ($row = mysqli_fetch_array($result)) {
  $incentive = ($row['amount']);
 }
}


  $total=$total-$paid+$incentive;
  $row_data = array(
    'ppayment' =>$openingBalance+$total
   );
  array_push($data, $row_data);
 echo json_encode($data);

?>
