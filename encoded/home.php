<?php if(isset($_GET[ 'page'])) $page=$_GET[ 'page']; else { $page="home" ; }

$result=query( "select count(*) from customer");
while($row=mysqli_fetch_array($result)) { $customers=$row[ 'count(*)']; }

$result=query( "select count(*) from product");
while($row=mysqli_fetch_array($result)) { $products=$row[ 'count(*)']; }

$result=query( "select count(*) from bill");
while($row=mysqli_fetch_array($result)) { $bills=$row[ 'count(*)']; }

$result=query( "select count(*) from account");
while($row=mysqli_fetch_array($result)) { $accounts=$row[ 'count(*)']; }

$result=query( "select count(*) from vendor");
while($row=mysqli_fetch_array($result)) { $vendors=$row[ 'count(*)']; }

$result=query( "select count(*) from member");
while($row=mysqli_fetch_array($result)) { $members=$row[ 'count(*)']; }

$result=query( "select count(*) from cheques");
while($row=mysqli_fetch_array($result)) { $cheques=$row[ 'count(*)']; }
?>

<style>
    .col-md-3 {
        padding-left: 2.5px;
        padding-right: 2.5px;
    }
    .col-md-6 {
        padding: 5px;
    }
    hr {
        margin:0px;
        margin-bottom:3px;
    }
    .gocenter
    {
        text-align: center;
    }
</style>


<div class="page-content">

    <!-- Page Heading -->
    <!--
                <div class="row">
                    <div class="col-lg-12">
                       
                        <ol class="breadcrumb">
                             <li>
                                <i class="fa fa-home"></i> Home
                            </li>
                        </ol>
                    </div>
                </div>
-->
    <!-- /.row -->


    <!--                    <a class="quick-button" href="index.php?page=cheques" >-->
    <!--                    <a class="quick-button" href="#" >-->
    <!--                        <img src="img/cheque.png" title="Cheques" />-->
    <!--                        <h4>Cheques</h4>-->
    <!--                        <span class="notification green">--><?php //echo number_format($cheques); ?><!--</span>-->
    <!--                    </a>-->

<!--    <a class="quick-button" href="index.php?page=sell">-->
<!--        <img src="img/orders.png" title="Orders" />-->
<!--        <h4>Orders</h4>-->
<!--        <span class="notification red">--><?php //echo number_format($bills); ?><!--</span>-->
<!--    </a>-->
<!--    <a class="quick-button" href="index.php?page=settings">-->
<!--        <img src="img/settings.png" title="Settings" />-->
<!--        <h4>Settings</h4>-->
<!--        <!--                <span class="notification green">67</span>-->
<!--    </a>-->


    <?php if($_SESSION['role']=="Admin") { ?>
        <div class="row">
            <div class="col-md-3">
                <div class="col-md-6">
                    <a class="quick-button" onclick="showReceivingVoucher();" >
                        <img src="img/payment.png" title="Payment Received Voucher" />
                        <h4 style="font-size:14px;"><b>Customer Receiving</b></h4>
                        <span class="notification yellow"><i class="fa fa-arrow-down"></i></span>
                    </a>
                </div>
                <div class="col-md-6">
                    <a class="quick-button" href="" data-target="#paymentPayingVoucher"  data-toggle="modal" >
                        <img src="img/payment.png" title="Payment Paid Voucher" />
                        <h4>Vendor Paying</h4>
                        <span class="notification red"><i class="fa fa-arrow-up"></i></span>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="col-md-6">
                    <a class="quick-button" href="index.php?page=vendors">
                        <img src="img/Vendor.png" title="Vendors" />
                        <h4>Vendors</h4>
                        <span class="notification blue"><?php echo number_format($vendors); ?></span>
                    </a>
                </div>
                <div class="col-md-6">
                    <a class="quick-button" href="index.php?page=customers">
                        <img src="img/customer.png" title="Customers" />
                        <h4>Customers</h4>
                        <span class="notification green"><?php echo number_format($customers); ?></span>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="col-md-6">
                    <a class="quick-button" href="index.php?page=stock">
                        <img src="img/products.png" title="Products" />
                        <h4>Inventory</h4>
                        <span class="notification green"><?php echo number_format($products); ?></span>
                    </a>
                </div>
                <div class="col-md-6">
                    <a class="quick-button" href="index.php?page=invoice">
                        <img src="img/Invoice.png" title="New Bill" />
                        <h4>New bill</h4>
                        <span class="notification green"><i class="fa fa-plus" ></i></span>
                    </a>
                </div>
            </div>



            <div class="col-md-3">
                <div class="col-md-6">
                    <a class="quick-button" href="index.php?page=accounts">
                        <img src="img/accounts.png" title="Accounts" />
                        <h4>Accounts</h4>
                        <span class="notification blue"><?php echo number_format($accounts); ?></span>
                    </a>
                </div>
                <div class="col-md-6">
                    <a class="quick-button" href="index.php?page=reports">
                        <img src="img/reports.png" title="Reports" />
                        <h4>Reports</h4>
                        <!--                <span class="notification green">67</span>-->
                    </a>
                </div>


            </div>
        </div>
    <?php } ?>
    <div class="row" style="padding:10px;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-dashboard"></i><span class="break"></span>&nbsp;Dashboard panel</h3>
            </div>
            <div class="panel-body" style="height:405px;">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-blue">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-group"></i><span class="break"></span>&nbsp;Members activities</h3>
                            </div>
                            <div class="panel-body panel-notify" style="height:300px;" >

                                <?php $result=query( "select m.id,m.name,m.cardno,m.name,sum(me.amount) amount from member m, mentry me where m.cardno=me.mno group by m.id order by sum(me.amount) desc  ;"); while($row=mysqli_fetch_array($result)) {   echo '<ul class="notification-panel" ><li><img class="dashboard-avatar" src="img/img.jpg"><b>Name:</b><a href="index.php?page=showMember&idno='.$row[ 'id']. '">'.$row[ 'name']. '.</a></li><li><b>Member Ship No:</b>&nbsp;'.$row[ 'cardno']. '.</li><li><b>Total Sale Amount:</b>&nbsp;Rs '.number_format($row[ 'amount']). '.</span></li></ul>'; } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-blue">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money"></i><span class="break"></span>&nbsp;Payments pending</h3>
                            </div>
                            <div class="panel-body panel-notify" style="height:300px;">

                                <?php $result=query( "select b.id,datediff(now(),b.ddate) as days from bill b WHERE b.ddate!='00-00-0000' and b.type='Invoice' ORDER by datediff(now(),b.ddate) DESC;");
                                while($row=mysqli_fetch_array($result))
                                {




                                    $billno=$row[ 'id'];

                                    $secondresult=query("select b.cid,b.amount,b.discount,DATE_FORMAT(b.date,'%d-%m-%Y') as date,DATE_FORMAT(b.ddate,'%d-%m-%Y') as ddate,b.notes,b.type from bill b where b.id='$billno'");
                                    while($row1=mysqli_fetch_array($secondresult))
                                    {
                                        $amount=$row1['amount'];
                                        $discount=$row1['discount'];
                                    }
                                    $thirdresult=query("select Sum(amount) as paid from billamounts where bid='$billno'");
                                    while($row2=mysqli_fetch_array($thirdresult))
                                    {
                                        $paid=$row2['paid'];
                                    }
                                    $pending=$amount-$paid-$discount;

                                    if($row['days']==-1)
                                    {
                                        $dis="Comming Payment due by Tomorrow.";
                                        $color="info";
                                        echo '<ul class="notification-panel" ><li><i class="dashboard-avatar fa fa-money fa-4x" style="border:none;"></i><b>Bill no:&nbsp;</b><a href="index.php?page=showbill&billno='.$row[ 'id']. '">'.$row[ 'id']. '.</a></li><li class="label label-md label-'.$color.'" >'.$dis. '</li><li><b> Payment:</b>&nbsp;RS&nbsp;'.number_format($pending,0).'.</li></ul>';
                                    }
                                    else
                                        if($row['days']<0&&$row['days']>-10)
                                        {
                                            $color="info";
                                            $dis="Comming Payment ".($row['days']*-1)." days left.";
                                            echo '<ul class="notification-panel" ><li><i class="dashboard-avatar fa fa-money fa-4x" style="border:none;"></i><b>Bill no:&nbsp;</b><a href="index.php?page=showbill&billno='.$row[ 'id']. '">'.$row[ 'id']. '.</a></li><li class="label label-md label-'.$color.'" >'.$dis. '</li><li><b> Payment:</b>&nbsp;RS&nbsp;'.number_format($pending,0).'.</li></ul>';
                                        }
                                        else if($row['days']>0)
                                        {
                                            $color="danger";
                                            $dis="Payment is Overdue by ".$row['days']." days.";
                                            echo '<ul class="notification-panel" ><li><i class="dashboard-avatar fa fa-money fa-4x" style="border:none;"></i><b>Bill no:&nbsp;</b><a href="index.php?page=showbill&billno='.$row[ 'id']. '">'.$row[ 'id']. '.</a></li><li class="label label-md label-'.$color.'" >'.$dis. '</li><li><b> Payment:</b>&nbsp;RS&nbsp;'.number_format($pending,0).'.</li></ul>';
                                        }
                                        else if($row['days']==0)
                                        {
                                            $color="success";
                                            $dis="Payment is due by Today.";
                                            echo '<ul class="notification-panel" ><li><i class="dashboard-avatar fa fa-money fa-4x" style="border:none;"></i><b>Bill no:&nbsp;</b><a href="index.php?page=showbill&billno='.$row[ 'id']. '">'.$row[ 'id']. '.</a></li><li class="label label-md label-'.$color.'" >'.$dis. '</li><li><b> Payment:</b>&nbsp;RS&nbsp;'.number_format($pending,0).'.</li></ul>';
                                        }

                                } ?>



                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-blue">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-briefcase"></i><span class="break"></span>&nbsp;Inventory Notifications</h3>
                            </div>
                            <div class="panel-body panel-notify" style="height:300px;" >

                                <?php $result=query( "select p.id,p.des,p.stock from product p where p.stock<=p.minstock  order by p.stock;"); while($row=mysqli_fetch_array($result)) {   echo '<ul class="notification-panel" ><li><img class="dashboard-avatar" src="img/products.png"><b>Product No#&nbsp;</b>'.$row[ 'id']. '.</li><li><b>Product des:&nbsp;</b>'.$row[ 'des']. '.</li><li><b>Current Stock:&nbsp;</b>&nbsp;'.$row[ 'stock']. '.</li></ul>'; } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<!-- jQuery -->
<div class="modal fade" id="paymentReceivingVoucher"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 5px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title gocenter" id="myModalLabel"><b>Payment Receiving Voucher</b></h3>
            </div>
            <div class="modal-body well">
                <form id="paymentReceivingForm">
                    <div class="row">
                        <div class="col-md-6" style="padding-left:0px; padding-bottom:3px;">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-slack"></i>&nbsp;S No</span>
                                <input id="serialNo" type="text" class="form-control" readonly tabindex="-1" value="PR-XXXX" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa  fa-calendar"></i>&nbsp;Date</span>
                                <input id="paymentReceivingDate" name="paymentReceivingDate" class="form-control"  type="text"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="padding-left:0px; padding-bottom:3px;">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i>&nbsp;Customer</span>
                                <select id="customerId" name="customerId" class="selectpicker show-tick" data-live-search="true" title="Customer"
                                        onchange="getCustomerData();">
                                    <?php
                                    $result=query("select id,name from customer where id!=1");
                                    while($row=mysqli_fetch_array($result))
                                    {
                                        echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa  fa-money"></i>&nbsp;Balance</span>
                                <input id="customerBalance" class="form-control"  type="text" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="padding-left:0px; padding-bottom:3px;">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-bars"></i>&nbsp;Payment Mode</span>
                                <select id="receivingPaymentMode" name="receivingPaymentMode"  class="form-control" onchange="onReceivingPaymentModeChange();">
                                    <?php
                                    $result=query("select id,name from paymentmodes where id = 1 or id = 3");
                                    while($row=mysqli_fetch_array($result))
                                    {
                                        echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding-right:0px">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-credit-card"></i>&nbsp;Payment Type</span>
                                <select class="form-control" id="receivingPaymentType" name="receivingPaymentType" >
                                    <option value="Credit">Credit</option>
                                    <option value="Debit">Debit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" id="receivingChequeBankContainer">
                        </div>
                    </div>
                    <div id="receivingPaymentModeContainer"></div>
                    <div class="row">
                        <div class="col-md-6" style="padding-left:0px; padding-bottom:3px;">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa  fa-file-text"></i>&nbsp;Detail</span>
                                <input id="receivingDetail" name="receivingDetail" class="form-control"  type="text"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa  fa-money"></i>&nbsp;Amount</span>
                                <input id="receivingAmount" name="receivingAmount" class="form-control"  type="number" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submitPaymentReceivingVoucher();"><i class="fa fa-save"></i>&nbsp;Save changes</button>
                <button type="button" class="btn btn-primary" onclick="submitAndPrintPaymentReceivingVoucher();"><i class="fa fa-print"></i>&nbsp;Save &amp; Print</button>
                <button type="button" id="btn_close" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Close</button>

            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="paymentPayingVoucher"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 5px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title gocenter" id="myModalLabel"><b>Payment Paying Voucher</b></h3>
            </div>
            <div class="modal-body well">
                <form id="paymentPayingForm">
                    <div class="row">
                        <div class="col-md-6" style="padding-left:0px; padding-bottom:3px;">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-slack"></i>&nbsp;S No</span>
                                <input id="serialNo" type="text" class="form-control" readonly tabindex="-1" value="PP-XXXX" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa  fa-calendar"></i>&nbsp;Date</span>
                                <input id="paymentPayingDate" name="paymentPayingDate" class="form-control"  type="text" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="padding-left:0px; padding-bottom:3px;">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i>&nbsp;Vendor</span>
                                <select id="vendorId" name="vendorId"  class="selectpicker show-tick" data-live-search="true" title="Select Vendor"
                                        onchange="getVendorData();" required>
                                    <?php
                                    $result=query("select id,name from vendor");
                                    while($row=mysqli_fetch_array($result))
                                    {
                                        echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa  fa-money"></i>&nbsp;Balance</span>
                                <input id="vendorBalance" class="form-control"  type="text" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="padding-left:0px; padding-bottom:3px;">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-bars"></i>&nbsp;Payment Mode</span>
                                <select id="payingPaymentMode" name="payingPaymentMode" class="form-control" onchange="onPayingPaymentModeChange();">
                                    <?php
                                    $result=query("select id,name from paymentmodes  where id = 1 or id = 3");
                                    while($row=mysqli_fetch_array($result))
                                    {
                                        echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding-right:0px">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-credit-card"></i>&nbsp;Payment Type</span>
                                <select class="form-control" id="payingPaymentType" name="payingPaymentType" >
                                    <option value="Debit">Debit</option>
                                    <option value="Credit">Credit</option>
                                </select>
                            </div>
                        </div>
                        <div id="payingChequeBankContainer" class="col-md-6">
                        </div>
                    </div>
                    <div id="payingPaymentModeContainer"></div>
                    <div class="row">
                        <div class="col-md-6" style="padding-left:0px; padding-bottom:3px;">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa  fa-file-text"></i>&nbsp;Detail</span>
                                <input id="payingDetail" name="payingDetail" class="form-control"  type="text"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa  fa-money"></i>&nbsp;Amount</span>
                                <input id="payingAmount" name="payingAmount"  class="form-control"  type="number" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="submitPaymentPayingVoucher();"><i class="fa fa-save"></i>&nbsp;Save </button>
                <button type="button" class="btn btn-primary" onclick="submitAndPrintPaymentPayingVoucher();"><i class="fa fa-print"></i>&nbsp;Save &amp; Print</button>
                <button type="button" id="btn_close" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Close</button>

            </div>

        </div>
    </div>
</div>


<input type="text" id="customerBalanceFigure" style="display: none;" >
<input type="text" id="vendorBalanceFigure" style="display: none;" >



<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/taffy-min.js"></script>
<script src="js/jquery.json-2.4.min.js"></script>
<script src="js/vouchers.js"></script>
<script src="js/bootstrap-select.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="js/datepicker.js"></script>
<script type="text/javascript">
    // When the document is ready
    $(document).ready(function () {

        $('#paymentPayingDate').datepicker({
            format: "dd-mm-yyyy"
        });
        $('#paymentPayingDate').datepicker('setValue','goToCurrent');
        $('#paymentReceivingDate').datepicker({
            format: "dd-mm-yyyy"
        });
        $('#paymentReceivingDate').datepicker('setValue','goToCurrent');
    });
</script>
