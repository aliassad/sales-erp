<?php
require("helpers.php");
$result= query('SELECT * from member');
$data = array();
while($row = mysqli_fetch_array($result)){
    $row_data = array(
        'id' => $row['id'],
        'name' => $row['name'],
        'cno' => $row['cardno'],
        'phone' => $row['phone'],
        'address' => $row['address']
    );
    array_push($data, $row_data);
}

echo json_encode($data);

?>