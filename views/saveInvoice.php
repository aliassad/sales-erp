<?php
require_once("helpers.php");

$notes=$_POST['notes'];
$type=$_POST['type'];
$cname=$_POST['customer'];
$duedate=$_POST['duedate'];
$gtotal=$_POST['total'];
$paid=$_POST['paid'];
$discount=$_POST['discount'];
$balance=$_POST['balance'];
$wname=$_POST['wname'];
$cno=$_POST['cno'];
$mno=$_POST['mno'];
$bdate=$_POST['bdate'];

$tableData = stripcslashes($_POST['pTableData']);


// Decode the JSON array
$tableData = json_decode($tableData,TRUE);
// now $tableData can be accessed like a PHP array
$r=query("select id from customer where concat(id,': ',name)='$cname'");
 if(!$r)
 {
     echo "false1";
 }
else{
  while($ro=mysqli_fetch_array($r))
    {
    $id=$ro['id'];
    }
if($id==1)
{
    $r=query("insert into wicustomer values('NULL','$wname','$cno')");
}






 $r=query("insert into bill values('NULL','$id','$discount','$gtotal',STR_TO_DATE('$bdate','%d-%m-%Y'),STR_TO_DATE('$duedate', '%d-%m-%Y'),'$notes',
 '$type')");
 if(!$r)
 {
     echo "false2";
 }
$r=query("select max(id) bid from bill");
      while($ro=mysqli_fetch_array($r))
    {
    $bid=$ro['bid'];
    }

    if($mno>0)
    {
        $r=query("insert into mentry values('NULL','$mno','$gtotal',STR_TO_DATE('$bdate','%d-%m-%Y'),'$bid')");
    }


    if($paid!=0){
    $r=query("insert into billamounts values('NULL','$bid','$paid',STR_TO_DATE('$bdate','%d-%m-%Y'));");
 if(!$r)
 {
     echo "false3";
 }      }
         for($i=0;$i<count($tableData);$i++)
            {
                    $s=$tableData[$i]['no'];
                    $product=$tableData[$i]['product'];
                    $rate=$tableData[$i]['rate'];
                    $unit=$tableData[$i]['unit'];
                    $disc=$tableData[$i]['disc'];
                    $amount=$tableData[$i]['amount'];
                     
					 
					 if($type=='Invoice')
					 {
                    query("UPDATE `product` SET `stock`=`stock`-'$unit' WHERE `des`='$product'");
					 }
					 
                    query("INSERT INTO lineitem VALUES (NULL,'$s','$bid','$product','$rate','$unit','$disc','$amount','0')");
            }

echo "true";
}
?>

