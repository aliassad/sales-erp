<html>

<head>
    
    
    <script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/taffy-min.js"></script>
<script src="../js/jquery.json-2.4.min.js"></script>

    <?php
require_once("helpers.php");
    $id=$_GET['billid'];
    $prebalance=$_GET['pre'];
    ?>
    
    <input  id="ssid" type="text" value="<?php echo $id; ?>" style="display:none;" />
    <input  id="pre" type="text" value="<?php echo $prebalance; ?>" style="display:none;" />
    <script>
        
        $(document).ready(function(){
  var url = 'gettingDayTransactions.php?ddate='+$('#ssid').val();
         
      $.getJSON(url,function(data){
          var $tdebit=0;
          var $tcredit=0;
          var db=TAFFY(data);
          var sorteddata=db().order("credit asec").get();
          var i=1;
          $.each(sorteddata,function(index,data){
          
            $tcredit+=parseFloat(data.credit);
            $tdebit+=parseFloat(data.debit);
          
            
          $('#dayTransactions').append("<tr><td>"+(i++)+"</td><td class='nocenter'>"+data.dis+"</td><td class='nocenter'>Rs "+parseFloat(data.credit).toLocaleString()+"</td><td class='nocenter'>Rs "+parseFloat(data.debit).toLocaleString()+"</td></tr>");  
       });
             
          

         $('#dec').html('Rs '+parseFloat($tcredit).toLocaleString()); 
         $('#inc').html('Rs '+parseFloat($tdebit).toLocaleString());
          var n=((parseFloat($('#pre').val())+parseFloat($tdebit))-parseFloat($tcredit)).toLocaleString();
         $('#balance').html('Rs '+n);
   });
            
        });
       
      
</script>


        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">

        <style>

            
            th,
            thead, {
                   
                   background-color:#eee;
            }
            .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
               padding:2px;  
               font-size:10px;
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
                margin-left: 2mm;
                margin-right: 2mm;
                margin-top:20mm;
                margin-bottom:10mm;
                break-inside: avoid-column;
                
            }
            .box
                {
                margin:10px;

                }
          
                        </style>


</head>

<body style="margin-top:10px;">
      <center style="margin-bottom:2px;">
            <b><h5><span>Day&nbsp;Book&nbsp;Print&nbsp;View&nbsp;<?php echo date("F j, Y, g:i a");?></span></h5></b></center>
    <div class="row box" >
       <div style="padding:2px;" >
       
<!--
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
                           
                        </td>
                    </tr>
                    <tr>
                        <td class="nocenter" style="font-size: 14px;"><i class="fa fa-calendar"></i>&nbsp;<b>Date: </b>
                            <?php echo $date; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="nocenter" style="font-size: 14px;"><i class="fa fa-calendar"></i>&nbsp;<b>Due by: </b>
                            <?php echo $duedate;  ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
-->
    </div>
    </div>
    <div class="row box">
        <div style="padding:2px;" >
        <table class="table" style="margin:0px;">
                        <thead>
                            <th class="no-center">
                                <i class="fa fa-pencil"></i>&nbsp;Trx id#
                            </th>
                            <th class="no-center">
                                <i class="fa fa-file"></i>&nbsp;Discription
                            </th>
                            <th class="no-center">
                                <i class="fa fa-upload"></i>&nbsp;Paid
                            </th>
                            <th class="no-center">
                                <i class="fa fa-download"></i>&nbsp;Recieved
                            </th>
                        </thead>
            <tbody id="dayTransactions">

            </tbody>
            <tfoot>

                <?php  

echo '<tr><td colspan="2"></td>
<td colspan="3" ><table class="table table-bordered" style="margin:10px 0px 0px 0px;"><tbody><tr><td class="nocenter" ><b>Previous Total:</b></td><td>RS '.number_format($prebalance,0).'</td></tr><tr><td class="nocenter" ><b>Amount Recieved:</b></td><td id="inc" ></td></tr><tr><td class="nocenter" ><b>Amount Paid:</b></td><td id="dec"></td></tr><tr><td class="nocenter" style="background-color:#777;"><p style="background-color:#777; ">Final Cash in hand:</p></td><td id="balance" ></td></tr></tbody></table></td></tr>';

?>


            </tfoot>
        </table>
        </div>
    </div>
</body>

</html>
 <script type="text/javascript">
            // When the document is ready
           
            
      $(document).ready(function () {
       setTimeout(function(){ window.print();
                             window.location="../index.php?page=daybook";
                            },800);

  
  
       
    });
            
</script>    

