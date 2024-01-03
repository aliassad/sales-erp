<?php
require_once("helpers.php");

$notes=$_POST['notes'];
$type=$_POST['type'];
$cname=$_POST['customer'];
$bid=$_POST['billid'];
$duedate=$_POST['duedate'];
$date=$_POST['ndate'];
$gtotal=$_POST['total'];
$paid=$_POST['paid'];
$discount=$_POST['discount'];
$balance=$_POST['balance'];

$tableData = stripcslashes($_POST['pTableData']);
// Decode the JSON array<br>
$tableData = json_decode($tableData,TRUE);
// now $tableData can be accessed like a PHP array
$r=query("select id from customer where name='$cname'");
 if(!$r)
 {
     echo "false";
     
 }
else{
  while($ro=mysqli_fetch_array($r))
    {
    $id=$ro['id'];
    }


 $r=query("UPDATE  bill SET `cid`='$id',`discount`='$discount',`amount`='$gtotal',`pending`='$balance',date=STR_TO_DATE('$date', '%d-%m-%Y'),ddate=STR_TO_DATE('$duedate', '%d-%m-%Y'),notes='$notes',type='$type' where id='$bid'");
 if(!$r)
 {
     echo "false1";
 }   


   
       for($i=0;$i<count($tableData);$i=$i+1)
            {

                    $s=$tableData[$i]['no'];
                    $artno=$tableData[$i]['artno'];
                    $product=$tableData[$i]['product'];
                    $des=$tableData[$i]['des'];
                    $rate=$tableData[$i]['rate'];
                    $unit=$tableData[$i]['unit'];
                    $amount=$tableData[$i]['amount'];
					if($type=='Invoice')
					{
                    $result=query("UPDATE `product` SET `stock`=`stock`-'$unit' WHERE `des`='$product'");
                    if(!$result)
                    {
                    echo "false2 ";
                    break;    
					}
					} 
                   $result=query("INSERT INTO `lineitem` (`id`, `lid`, `bid`, `product`, `des`, `artno`, `rate`, `unit`, `amount`, `status`) VALUES (NULL, '$s','$bid','$product', '$des', '$artno', '$rate', '$unit', '$amount','0')");
                    if(mysqli_affected_rows() <= 0)
                    {
                    echo "false3 ".$s.' '.$bid.' '.$product.' '.$des.' '.$artno.' '.$rate.' '.$unit.' '.$amount;
					
                     break;
                    }
            }
echo var_dump($tableData);
}
?>

