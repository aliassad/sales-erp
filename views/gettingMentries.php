<?php
require("helpers.php");
$id=$_GET['id'];
$result= query("SELECT id,bid,amount,DATE_FORMAT(date, '%d-%m-%Y') as date from mentry WHERE mno='$id' ORDER by id DESC ");
$data = array();
while($row = mysqli_fetch_array($result)){
    $row_data = array(
        'id' => $row['id'],
        'amount' => $row['amount'],
        'bid' => $row['bid'],
        'date' => $row['date'],
    );
    array_push($data, $row_data);
}

echo json_encode($data);

?>