
<?php
$lastMonth = date("d-M-Y", strtotime('-1 months'));
$today = date("d-M-Y");

?>
<div class="container-fluid">
    <div class="page-content">
        <!-- Page Heading -->


        <div class="row">
           <div class="col-md-4" style="padding-left:0px;">
            <div class="btn-group btn-breadcrumb">
                <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                <a href="index.php?page=accounts" class="btn btn-default"><i class="fa fa-dollar"></i>&nbsp;Accounts</a>
                <a href="#" class="btn btn-primary"><i class="fa fa-book"></i>&nbsp;Day Book</a>
            </div>
        </div>
             <div class="col-md-8">
        <div  style="margin-bottom:10px; padding:5px;">
            
            <a href="#" class="btn btn-md btn-success" style="float:right; margin-left:5px;margin-top:5px;" data-toggle="modal" data-target="#bankSheet" onclick="loadDetails();" >
                <i class="fa fa-bank"></i>&nbsp;Bank Accounts Details</a>
            <button class="btn btn-md btn-warning" type="text" style="float:right;margin-top:5px; margin-right:10px;" class="form-control" onclick="printdaybook();"><i class="fa fa-print"></i>&nbsp;Print</button>
                 </div>
            </div>
        </div>
        <div class="row" style="margin-top:0px;">
            <div class="col-md-6" style="padding:0px; padding-right:20px;">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i>&nbsp;From Date#</span>
                    <input id="fdate" type="text" placeholder="click to select date" class="form-control" value="<?php echo $lastMonth;?>">
                    <span class="input-group-addon">  to</span>
                    <input id="tdate" placeholder="click to select date" type="text" class="form-control"  value="<?php echo $today;?>">
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-info btn-md" onclick="loadData();">GO</button>
            </div>
              <div class="col-md-4" style="padding:0px;">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Previous Cash Balance:</span>
                    <input id="daycash" type="text" class="form-control" readonly/>
                    
                </div>
                  <input id="daycashn" type="text" style="display:none;"class="form-control" readonly/>
            </div>

        </div>
        <!-- /.row -->




        <div class="panel panel-default" style="margin-top:0px;">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-certificate"></i><span class="break"></span>&nbsp;Day Transactions</h3>
            </div>
            <div class="panel-body" style="height:335px; overflow-y:auto; padding:0px;">
                <div class="row">
                    
                    <table class="table table-bordered table-hover" style="padding:0px;">
                        <thead>
                            <th class="text-center">
                                <i class="fa fa-pencil"></i>&nbsp;Trx Sr#
                            </th>
<!--
                            <th class="text-center">
                                <i class="fa fa-calendar"></i>&nbsp;Date
                            </th>
-->
                            <th class="text-center">
                                <i class="fa fa-file"></i>&nbsp;Discription
                            </th>
                            <th class="text-center">
                                <i class="fa fa-upload"></i>&nbsp;Paid
                            </th>
                            <th class="text-center">
                                <i class="fa fa-download"></i>&nbsp;Recieved
                            </th>
                        </thead>
                    
                        
                        <tbody id="dayTransactions">
                        </tbody>
                           
                    </table>


                </div>
            </div>
                            <div class="panel-footer clearfix" style="padding-top: 0px; padding-bottom: 0px; margin: 0px;">
                    <table class="table" style="margin: 0px;">
                        <thead>
                            <th>&nbsp;<i class="fa fa-download"></i>&nbsp;Toatl Recieved:</th>
                            <th>&nbsp;<i class="fa fa-upload"></i>&nbsp;Toatl Paid:</th>
                            <th>&nbsp;<i class="fa fa-money"></i>&nbsp;Final Cash in hand(PKR):</th>
                        </thead>
                        <tbody>
                            <tr id="discount">
                                <td>
                                    <input type="text" id="totaldebit" class="form-control"  placeholder="0.0" readonly/>
                                </td>
                                <td>
                                    <input type="text" id="totalcredit" class="form-control"  placeholder="0.0" readonly/>
                                </td>
                                <td>
                                    <input type="text" id="totalcash" class="form-control" placeholder="0.0" readonly/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>

    </div>





</div>
</div>


<div class="modal fade" id="bankSheet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bank fa-2x"></i>&nbsp;Banks Details</h4>
                </div>
                <div class="modal-body well">

                        <div class="row">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-search" ></i>&nbsp;Bank Acno</span>
                                 <input  id="bankname" type="text" class="form-control" onkeyup="filterbank();">
                                </div>
                            </div>
                    <label class="label label-md label-default"><i class="fa fa-dashboard"></i>&nbsp;Banks Details</label>
                    <center>
                        <div style="border: 3px solid lightblue; height:330px; overflow-y: auto;">
                            <table class="table table-striped" >
                                <thead>
                                    <th><i class="fa fa-pencil"></i>&nbsp;Sr#</th>
                                    <th><i class="fa fa-tags"></i>&nbsp;Bank Account No</th>
                                    <th><i class="fa fa-download"></i>&nbsp;Debit</th>
                                    <th><i class="fa fa-upload"></i>&nbsp;Credit</th>
                                    <th><i class="fa fa-money"></i>&nbsp;Balance</th>
                                    
                                </thead>
                                <tbody id="bankList" >
                                </tbody>
                            </table>
                        </div>
                    </center>
                    
                </div>
            </div>
        </div>
    </div>



<style>

    .row
{
    padding-bottom:10px; 
}
</style>


<!-- /.container-fluid -->
<!-- /#page-wrapper 
    <!-- /#wrapper -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/taffy-min.js"></script>
<script src="js/jquery.json-2.4.min.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="js/datepicker.js"></script>
<script src="js/daybook.js"></script>
<script src="js/jQuery-print.js"></script>
 <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {


                $('#fdate').datepicker({
                    format: "dd-M-yyyy"
                });
                $('#tdate').datepicker({
                    format: "dd-M-yyyy"
                });
                });



        </script>

