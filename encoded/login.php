<?php


session_start();
session_regenerate_id(true);
require_once("helpers.php");

ob_start(); // Turn on output buffering
system('ipconfig /all');
$mycom=ob_get_contents();
ob_clean();
$findme = "Physical";
$pmac = strpos($mycom, $findme);
$mac=substr($mycom,($pmac+36),17);

$email=$_POST["email"];
$pass=$_POST["pass"];
$email=stripslashes($email);
$pass=stripslashes($pass);


$company_id = -1;
$result = query("select * from company where system_detail = MD5('$mac')");
while ($row=mysqli_fetch_array($result)){
    $company_id = $row['id'];
    $days_limit = $row['days_limit'];
    $salt = $row['salt'];
}
$limit = base64_decode($days_limit);
$limit*=1;
$limit-=1;
$limit=base64_encode($limit);

$result = query("update company set days_limit='$limit' where id='$company_id'");


if($company_id == -1||base64_decode($salt)!=='aliassad110'||base64_decode($limit)<=0){
    echo "Store computer does not match please contact software vendor (+92-3348101214)";
    exit;
}




$result=query("select * from login where email='$email' and pass=MD5('$pass')");

$num_rows=mysqli_num_rows($result);
if($num_rows>0){
    while($row=mysqli_fetch_array($result))
    {
    $_SESSION['id']=$row['id'];
    $_SESSION['role']=$row['role'];
    }

    if($_SESSION['role']=="Admin")
   echo 2;
    else
   echo 3;
}
else 
   echo true;

?>


