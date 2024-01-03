<html>

<head>
    <?php
require_once("helpers.php");
$bid=$_GET['billid'];



$result=query("select notes,amount,discount,cid,type,DATE_FORMAT(date,'%d-%m-%Y') as date from bill where id='$bid'");
$cid="";
$date="";
$duedate="";
$notes="";
$amountp="";
$gtotal="";

$type="";
$discount="";
while($row=mysqli_fetch_array($result))
{
    $date=$row['date'];
    $notes=$row['notes'];
    $gtotal=$row['amount'];
    $discount=$row['discount'];
    $cid=$row['cid'];
    $type=$row['type'];
    
}



$result=query("select Sum(amount) as paid from billamounts where bid='$bid'");
while($row=mysqli_fetch_array($result))
{
 $amountp=$row['paid'];
}

$result=query("select * from customer where id='$cid'");
$cname="";
$phone="";
$address="";
while($row=mysqli_fetch_array($result))
{
    $cname=$row['name'];
    $phone=$row['phone'];
    $address=$row['address'];
}

    if(isset($_GET['wn'])) {
        $cname = $_GET['wn'];
        $address="";
    }
    if(isset($_GET['wno'])) {
        $phone = $_GET['wno'];
        $address="";
    }

?>


        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">

        <style>

            
            th,
            thead, {
                   
                   background-color:#eee;
            }
            .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
               padding:2px;  
               font-size:14px;
            }
            
            @media print 
            {
            *{-webkit-print-color-adjust:exact;   }
            
            
            }
            
            @page {
                  webkit-print-color-adjust:exact;  
                size: A4;
                /* auto is the initial value */
                /* this affects the margin in the printer settings */
                margin-left: 7mm;
                margin-right: 7mm;
                margin-top:20mm;
                margin-bottom:10mm;
                page-break-inside: avoid;
                
            }
            .box
                {
                margin:10px;

                }
          
                        </style>


</head>

<body style="margin-top:10px;">
     <center style="margin-bottom:2px;"><h6 id="type" style="border:4px double black;"><?php echo  $type; ?></h6></center>
    <div class="row box" >
       <div style="padding:2px;" >
       
        <div class="col-md-5">
            <table class="table" style="margin:0px;">
                <tbody>
                    <tr>
                        <td class="nocenter" style="font-size: 14px;"><b><i class="fa fa-user"></i>&nbsp;Name:</b>
                            <?php echo $cname; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="nocenter" style="font-size: 14px;"><b><i class="fa fa-phone "></i>&nbsp;Phone:</b>
                            <?php echo $phone; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="nocenter" style="font-size: 14px;"><b><i class="fa fa-book"></i>&nbsp;Address:</b>
                            <?php echo $address; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-5 col-md-offset-2">
            <table class="table" style="margin:0px;">
                <tbody>
                    <tr>
                        <td class="nocenter" style="font-size: 14px;">
                            <i class="fa fa-tag"></i>&nbsp;<b>Customer Order id: </b>
                            <?php echo $bid; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="nocenter" style="font-size: 14px;"><i class="fa fa-calendar"></i>&nbsp;<b>Date: </b>
                            <?php echo $date; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <div class="row box">
        <div style="padding:2px;" >
        <table class="table" style="margin:0px;">
            <thead>
            <th class="text-center">
                <i class="fa fa-pencil "></i>&nbsp;Item no#
            </th>
            <th class="text-center">
                <i class="fa fa-briefcase "></i>&nbsp;Product
            </th>
            <th class="text-center">
                <i class="fa fa-money "></i>&nbsp;@
            </th>
            <th class="text-center">
                <i class="fa fa-table"></i>&nbsp;Qty
            </th>
            <th class="text-center">
                <i class="fa fa-money "></i>&nbsp;Amount
            </th>
            </thead>
            <tbody class="items">
                <?php  
                             $result=query("select * from lineitem where bid='$bid'");
                                        while($row=mysqli_fetch_array($result))
                                        {
                                    $s=$row['lid'];
                                    $product=$row['product'];
                                    $rate=$row['rate'];
                                    $unit=$row['unit'];
                                    $amount=$row['amount'];
              echo '<tr class="items"><td class="text-center" >'.$s.'</td><td>'.$product.'</td><td class="text-center" >'.$rate.'</td><td class="text-center" >'.$unit.'</td><td class="text-center" >'.$amount.'</td></tr>';
                                    }

                      ?>



            </tbody>
            <tfoot>
                <?php  if($discount>0){

echo '<tr><td colspan="3" rowspan="3" style="border-style:none;"><table class="table table-bordered" style="margin:0px;"><thead><th style="background:lightgrey;" ><i class="fa fa-newspaper-o"></i> Notes</th></thead><tbody><tr><td><textarea id="mnot" class="form-control" rows="3" style="font-size:14px;" readonly>'.$notes.'</textarea></td></tr></tbody> </table></td>
<td colspan="4" ><table class="table table-bordered" style="margin:10px 0px 0px 0px;"><tbody><tr><td class="nocenter" ><b>Grand Total:</b></td><td class="nocenter" > RS '.number_format($gtotal,0).'</td></tr><tr><td class="nocenter" ><b>Amount Paid:</b></td><td class="nocenter" > RS '.number_format($amountp,0).'</td></tr><tr><td class="nocenter" ><b>Discount:</b></td><td class="nocenter"> RS '.number_format($discount,0).'</td></tr><tr><td class="nocenter" style="background-color:#777;"><p style="background-color:#777; ">Balance:</p></td><td class="nocenter " > RS '.number_format(($gtotal-$amountp-$discount),0).'</td></tr></tbody></table></td></tr>';

}else
        {                

echo '<tr><td colspan="3" rowspan="3" style="border-style:none;"><table class="table table-bordered" style="margin:0px;"><thead><th style="background:lightgrey;" ><i class="fa fa-newspaper-o"></i> Notes</th></thead><tbody><tr><td><textarea id="mnot" class="form-control" rows="3" style="font-size:14px;" readonly>'.$notes.'</textarea></td></tr></tbody> </table></td>
<td colspan="4" ><table class="table table-bordered" style="margin:10px 0px 0px 0px;"><tbody><tr><td class="nocenter" ><b>Grand Total:</b></td><td class="nocenter" > RS '.number_format($gtotal,0).'</td></tr><tr><td class="nocenter" ><b>Amount Paid:</b></td><td class="nocenter" > RS '.number_format($amountp,0).'</td><tr><td class="nocenter" style="background-color:#777;"><p style="background-color:#777; ">Balance:</p></td><td class="nocenter " > RS '.number_format(($gtotal-$amountp),0).'</td></tr></tbody></table></td></tr>';
}
?>

            </tfoot>
        </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <p style="float:left"><b>Note:</b>&nbsp;Computer Generated Slip is invalid Without Signature and Stamp.<p style="float:right">Signature and Stamp</p>
    </div>
    <input type="text" id="ssid" value="<?php echo $bid; ?>" style="display:none;"/>
</body>

</html>

<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.js"></script>
 <script type="text/javascript">
            // When the document is ready
           
            
      $(document).ready(function () {
        window.print();
       setTimeout(function(){window.location="../index.php?page=sell";},2000);
    });
            
</script>    