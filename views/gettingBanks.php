<?php
require("helpers.php");
$i=1;

$result =query("SELECT * from account ");
$data = array();
while($row = mysqli_fetch_array($result)){
    $row_data = array(
        'id' => $row['id'],
        'code' => $row['code']
    );
    array_push($data, $row_data);
    $i=$i+1;
}

echo json_encode($data);
?>