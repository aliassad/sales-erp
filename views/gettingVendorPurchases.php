<?php
require("helpers.php");

$vid = $_GET['id'];

$result = query("SELECT (select concat(pr.article_no,' ', pr.origin,' ',pr.des,' ',pr.item_length,'*',pr.item_width,': ',(ROUND(pr.item_length*pr.item_width/10000,2)),' SQM') from product pr where pr.id=p.pid ) as product, p.amount,p.id,p.pid,p.qty,p.rate,DATE_FORMAT(p.date, '%d-%m-%Y') as date from vendorpurchase p WHERE  p.vp='$vid'");
$data = array();
while ($row = mysqli_fetch_array($result)) {
    $row_data = array(
        'id' => $row['id'],
        'product_id' => $row['pid'],
        'product' => $row['product'],
        'unit' => $row['qty'],
        'rate' => $row['rate'],
        'amount' => $row['amount'],
        'date' => $row['date']
    );
    array_push($data, $row_data);
}

echo json_encode($data);
?>