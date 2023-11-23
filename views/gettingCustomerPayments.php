<?php
require("helpers.php");

$id=$_GET['id'];
$result=query("select cp.id,cp.amount,cp.ptype,cp.pdetail,DATE_FORMAT(cp.date,'%d-%m-%Y') as date from customerpayments cp where cp.cid='$id';");
$data = array();
while($row = mysqli_fetch_array($result)){

    $row_data = array(
        'id' => $row['id'],
        'amount' => round($row['amount']),
        'date' => $row['date'],
        'type' => $row['ptype'],
        'detail' => $row['pdetail']
    );
    array_push($data, $row_data);
}

echo json_encode($data);
?>
