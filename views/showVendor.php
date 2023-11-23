<style>
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        padding: 0px;
    }

    .ab > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        padding: 1px;
    }
</style>
<?php
setlocale(LC_MONETARY, "en_US");
$eid = $_GET["id"];
$result = query("select * from vendor where id='$eid'");
$vendor_row = "";
while ($row = mysqli_fetch_array($result)) {
    $vendor_row = $row;
    $name = $row['name'];
    $nic = $row['nic'];
    $phone = $row['phone'];
    $email = $row['email'];
    $address = $row['address'];
    $company = $row['companyname'];
    $city = $row['city'];
    $opening_balance = $row['openingbalance'];
    if ($row['img'])
        $img = $row['img'];
    else $img = "img/img.jpg";
}

$paidAmount = 0;
$receivedAmount = 0;
$pendingpayment = 0;

$result = query("select sum(amount) amount from 
vendorpayments where vid='$eid' and 
ptype='Debit'");
while ($row = mysqli_fetch_array($result)) {
    $paidAmount = $row['amount'];
}
$result = query("select sum(amount) amount from 
vendorpayments where vid='$eid' and 
ptype='Credit'");
while ($row = mysqli_fetch_array($result)) {
    $receivedAmount = $row['amount'];
}
$result = query("select sum(p.qty*p.rate) as amount from vendorpurchase p where p.vp='$eid'");
while ($row = mysqli_fetch_array($result)) {
    $pendingpayment = $row['amount'];
}
$pendingpayment = $pendingpayment - $paidAmount + $receivedAmount + $opening_balance;
?>

<input id="userRole" value="<?php echo $_SESSION['role']; ?>" style="display: none;">


<div class="page-content">

    <!-- Page Heading -->


    <div class="row">
        <div class="btn-group btn-breadcrumb">
            <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
            <a href="index.php?page=accounts" class="btn btn-default"><i class="fa fa-dollar"></i>&nbsp;Accounts</a>
            <a href="index.php?page=vendors" class="btn btn-default"><i class="fa fa-group"></i>&nbsp;Vendors</a>
            <a href="#" class="btn btn-primary"><i class="fa fa-user"></i>&nbsp;Vendor Details</a>
        </div>
    </div>


    <div class="row">
        <div class="col-md-10 col-md-offset-1" style="padding-right:1px; padding-left:0px;">
            <div class="panel panel-info" style="margin-top:10px;">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-user"></i><b>&nbsp;Vendor Details:</b></h3>
                    <span id="eid" style="display: none;"><?php echo $eid; ?></span>
                    <?php if ($_SESSION['role'] == "Admin") { ?>
                        <a onclick="deleteEmployee(<?php echo $eid; ?>)" class="btn btn-md btn-danger"
                           style="float:right; margin-top:25px; margin-bottom:5px;"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                        <a class="btn btn-md btn-primary" onclick="loadData();" data-toggle="modal"
                           data-target="#editEmployeeModal"
                           style="float:right; margin-top:25px; margin-bottom:5px; margin-right:5px;"><i
                                    class="fa fa-edit"></i>&nbsp;Edit</a> <?php } ?>
                    <a class="btn btn-md btn-warning" data-toggle="modal" data-target="#paymentsSheet"
                       style="float:right; margin-top:25px; margin-bottom:5px; margin-right:5px;"
                       onclick="loadPayments();"><i class="fa fa-money"></i>&nbsp;Payments sheet</a>
                </div>
                <div class="panel-body well" style="margin: 0px; padding:5px;">
                    <div class="row">
                        <div class="col-md-8" style="padding-right: 0px;">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6"
                                         style="padding-top:10px; padding-left:0px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-hashtag"></i>&nbsp;Vendor No</span>
                                            <input name="evendor_no" id="evendor_no" type="text" class="form-control"
                                                   value="<?php echo $vendor_row['vendor_no']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6"
                                         style="padding-top:10px; padding-left:10px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i>&nbsp;Name</span>
                                            <input name="etname" id="etname" type="text" class="form-control"
                                                   value="<?php echo $name; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"
                                         style="padding-top:10px; padding-left:0px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="fa fa-globe"></i>&nbsp;Email</span>
                                            <input name="eemail" id="eemail" type="email" class="form-control"
                                                   value="<?php echo $email; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6"
                                         style="padding-top:10px; padding-left:10px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="fa fa-phone"></i>&nbsp;Phone</span>
                                            <input name="ephone" id="ephone" type="text" class="form-control"
                                                   value="<?php echo $phone; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"
                                         style="padding-top:10px; padding-left:0px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="fa fa-building"></i>&nbsp;Country</span>
                                            <input name="ecountry" id="ecountry" type="text" class="form-control"
                                                   value="<?php echo $vendor_row['country']; ?>"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6"
                                         style="padding-top:10px; padding-left:10px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="fa fa-building"></i>&nbsp;City</span>
                                            <input name="ecity" id="ecity" type="text" class="form-control"
                                                   value="<?php echo $city; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"
                                         style="padding-top:10px; padding-left:0px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-hashtag"></i>&nbsp;Zip Code</span>
                                            <input name="ezip_code" id="ezip_code" type="text" class="form-control"
                                                   value="<?php echo $vendor_row['zip_code']; ?>"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6"
                                         style="padding-top:10px; padding-left:10px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="fa fa-hashtag"></i>&nbsp;UID</span>
                                            <input name="euid_no" id="euid_no" type="text" class="form-control"
                                                   value="<?php echo $vendor_row['uid_no']; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"
                                         style="padding-top:10px; padding-left:0px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-hashtag"></i>&nbsp;Account No</span>
                                            <input name="eaccount_no" id="eaccount_no" type="text" class="form-control"
                                                   value="<?php echo $vendor_row['account_no']; ?>"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6"
                                         style="padding-top:10px; padding-left:10px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon">&nbsp;GST %</span>
                                            <input name="egst" id="egst" type="text" class="form-control"
                                                   value="<?php echo $vendor_row['gst']; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"
                                         style="padding-top:10px; padding-left:0px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-home"></i>&nbsp;Company Name</span>
                                            <input name="ecompany" id="ecompany" type="text" class="form-control"
                                                   value="<?php echo $company; ?>"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6"
                                         style="padding-top:10px; padding-left:10px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="fa fa-book"></i>&nbsp;Address</span>
                                            <textarea name="eaddress" id="eaddress" type="text" class="form-control"
                                                      rows="1" cols="5" readonly><?php echo $address; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" style="padding:0;padding-left:0px; padding-top:10px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Opening Balance</span>
                                            <input name="eopening_balance" id="eopening_balance" type="text"
                                                   class="form-control"
                                                   value="<?php echo CURRENCY_SYMBOL . ' ' . number_format($opening_balance, 2); ?>"
                                                   readonly/>
                                            <input name="evopening_balance" id="evopening_balance" type="hidden"
                                                   class="form-control"
                                                   value="<?= $opening_balance ?>"
                                                   readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="padding:0px;padding-left:10px; padding-top:10px;">
                                        <div class="input-group">
                                            <span class="input-group-addon red"><i class="fa fa-money"></i>&nbsp;Total Amount to Pay</span>
                                            <input name="payment" id="payment" type="text" class="form-control"
                                                   value="<?php echo CURRENCY_SYMBOL . ' ' . number_format($pendingpayment, 2); ?>"
                                                   readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4" style="padding-top:0px;">
                            <div class="panel panel-default" style="margin-bottom: 0px;">
                                <div class="panel-body notification-panel">
                                    <img class="img-responsive" id="epreview" src="<?php echo $img; ?>" style="min-height:120px; min-width:150px;
                                    max-height: 160px; max-width:220px;"/>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--<div class="col-md-5" style="padding-right:0px; padding-left:1px;">
            <div class="panel panel-warning" style="margin-top:10px;">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-money"></i>&nbsp;<b>Add Payment and Payments Histoy:</b></h3>
                        <a class="btn btn-md btn-warning"  data-toggle="modal" data-target="#paymentsSheet" style="float:right; margin-top:25px; margin-bottom:5px; margin-right:5px;" onclick="loadPayments();"><i class="fa fa-money"></i>&nbsp;Payments sheet</a>
                        <a class="btn btn-md btn-info"  data-toggle="modal" data-target="#advanceSheet" style="float:right; margin-top:25px; margin-bottom:5px; margin-right:5px;" onclick="loadAdvance();"><i class="fa fa-money"></i>&nbsp;Advances sheet</a>
                </div>
                <div class="panel-body well" style="margin: 0px; padding-top:65px;">
                    <div class="row">
                          <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money" ></i>&nbsp;Give Amount</span>
                                <input name="gamount" id="gamount" type="number" class="form-control" value='' onkeyup="calAmount();">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money" ></i>&nbsp;Give Advance</span>
                                <input name="gadvance" id="gadvance" type="number" class="form-control" value='' onkeyup="calAmount();">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money" ></i>&nbsp;Deduct Advance</span>
                                <input name="dadvance" id="dadvance" type="number" class="form-control" value='' onkeyup="calAmount();">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money" ></i>&nbsp;Remainig Advance</span>
                                <input name="radvance" id="radvance" type="text" class="form-control" value='' readonly>
                            </div>
                        </div>
                                                    <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money" ></i>&nbsp;Final Advance to Pay</span>
                                <input name="fadvance" id="fadvance" type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money" ></i>&nbsp;Final Amount to Pay</span>
                                <input name="famount" id="famount" type="text" class="form-control" value='<?php ?>' readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <center><button id="btn_save" onclick="payAmount();" class="btn btn-lg btn-primary" disabled><i class="fa fa-save"></i>&nbsp;Submit</button></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
</div>


<!--
<div class="row" style="margin-top:10px;">
    <div class="panel panel-success" style="margin-top:10px;">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-tasks"></i><span class="break"></span>&nbsp; New Item Entry</h3>
            </div>
            <div class="panel-body" style=" padding:0px;">
           <table class="table table-bordered table-hover ab" style="padding:0px; margin-bottom: 0px;">
                        <thead>
                            <th class="text-center">
                                <i class="fa fa-file"></i>&nbsp;Discription
                            </th>
                            <th class="text-center">
                                <i class="fa fa-table"></i>&nbsp;Unit
                            </th>
                            <th class="text-center">
                                <i class="fa fa-money"></i>&nbsp;@
                            </th>
                            <th class="text-center">
                                <i class="fa fa-money"></i>&nbsp;Amount
                            </th>
                            <th class="text-center">
                                <i class="fa fa-plus"></i>&nbsp;
                            </th>
                        </thead>
                        <tbody>
                            <td><input class="form-control" type="text" placeholder="Dicription" id="newdis" tabindex="1"/></td>
                            <td><input class="form-control" type="number" placeholder="Unit" id="newunit" onkeyup="calamount();" tabindex="2" /></td>
                            <td><input class="form-control" type="number" placeholder="Rate" id="newrate" onkeyup="calamount();" tabindex="3"/></td>
                            <td><input class="form-control" type="number" id="newamount" readonly/></td>
                            <td><a  class="btn btn-custom btn-md btn-warning btn-block" onfocus="saveItem();" tabindex="4">
            <i class="fa fa-plus"></i>&nbsp;Add Entry</a></td>
                        </tbody>

                    </table>



</div>
    </div>
</div>
-->

<div class="row" style="margin-top:10px;">
    <div class="col-md-6" style="padding:0px;">

        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i>&nbsp;From Date#</span>
            <input id="fdate" type="text" placeholder="click to select date" class="form-control"
                   onchange="filterPurchase();">
            <span class="input-group-addon">  to</span>
            <input id="tdate" type="text" placeholder="click to select date" class="form-control"
                   onchange="filterPurchase();">
        </div>
    </div>


</div>


<div class="panel panel-default" style="margin-top:10px;">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-tasks"></i><span class="break"></span>&nbsp; Purchased Items</h3>
    </div>
    <div class="panel-body" style="height:380px; overflow-y:auto; padding:0px;">
        <div class="row">
            <table class="table table-bordered table-hover ab" id="vendorp" style="padding:0px;">
                <thead>
                <th class="text-center">
                    <i class="fa fa-pencil"></i>&nbsp;id#
                </th>
                <th class="text-center">
                    <i class="fa fa-calendar"></i>&nbsp;Date
                </th>
                <th class="text-center">
                    <i class="fa fa-briefcase"></i>&nbsp;Product
                </th>
                <th class="text-center">
                    <i class="fa fa-table"></i>&nbsp;Qty
                </th>
                <th class="text-center">
                    <i class="fa fa-money"></i>&nbsp;@
                </th>
                <th class="text-center">
                    <i class="fa fa-money"></i>&nbsp;Amount
                </th>
                <th class="text-center">
                    <i class="fa fa-edit"></i>&nbsp;
                </th>
                <th class="text-center">
                    <i class="fa fa-trash"></i>&nbsp;
                </th>
                </thead>
                <tbody id="vendorpurchase"></tbody>
                <tfoot>

                </tfoot>
            </table>


        </div>
    </div>
</div>


<input id="empid" type="number" value="<?php echo $eid; ?>" style="display:none;">


<div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user fa-2x"></i>&nbsp;Edit Vendor Details</h4>
            </div>
            <div class="modal-body well">
                <form id="employeeForm">
                    <input type="text" id="vid" name="vid" style="display: none;" value="<?= $eid; ?>"/>
                    <div class="row">
                        <div class="col-md-8" style="padding-right: 0px;">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6"
                                         style="padding-top:0px; padding-left:0px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Opening Balance</span>
                                            <input name="vopening_balance" id="vopening_balance" type="text"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"
                                         style="padding-top:20px; padding-left:0px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon">Vendor #</span>
                                            <input name="vvendor_no" id="vvendor_no" type="text" class="form-control"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6"
                                         style="padding-top:20px; padding-left:10px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i>&nbsp;Name</span>
                                            <input name="vname" id="vname" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"
                                         style="padding-top:20px; padding-left:0px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="fa fa-globe"></i>&nbsp;Email</span>
                                            <input name="vemail" id="vemail" type="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6"
                                         style="padding-top:20px; padding-left:10px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="fa fa-phone"></i>&nbsp;Phone</span>
                                            <input name="vphone" id="vphone" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"
                                         style="padding-top:20px; padding-left:0px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-building-o"></i>&nbsp;Country</span>
                                            <select id="vcountry" name="vcountry" class="selectpicker show-tick"
                                                    data-live-search="true" title='Select
                                            Country...'>
                                                <?php
                                                $result = query("select country_name from countries order by country_name");
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo '<option>' . $row['country_name'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6"
                                         style="padding-top:20px; padding-left:10px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="fa fa-building-o"></i>&nbsp;City</span>
                                            <select id="vcity" name="vcity" class="selectpicker show-tick"
                                                    data-live-search="true" title='Select
                                            City...'>
                                                <?php
                                                $result = query("select name from cities order by name");
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo '<option>' . $row['name'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"
                                         style="padding-top:20px; padding-left:0px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-hashtag"></i>&nbsp;Zip Code</span>
                                            <input name="vzip_code" id="vzip_code" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6"
                                         style="padding-top:20px; padding-left:10px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="fa fa-hashtag"></i>&nbsp;UID</span>
                                            <input name="vuid_no" id="vuid_no" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"
                                         style="padding-top:20px; padding-left:0px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-hashtag"></i>&nbsp;Account No</span>
                                            <input name="vaccount_no" id="vaccount_no" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6"
                                         style="padding-top:20px; padding-left:10px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon">GST %</span>
                                            <input name="vgst" id="vgst" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"
                                         style="padding-top:20px; padding-left:0px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="fa fa-book"></i>&nbsp;Address</span>
                                            <textarea name="vaddress" id="vaddress" type="text" class="form-control"
                                                      rows="2" cols="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6"
                                         style="padding-top:20px; padding-left:10px; padding-right:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-home"></i>&nbsp;Company Name</span>
                                            <textarea name="vcompany" id="vcompany" type="text" class="form-control"
                                                      rows="2" cols="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <img class="img-responsive" id="preview" src="img/img.jpg"
                                         style="max-height:150px; max-width:230px;"/>
                                    <input tabindex="-1" style="margin-top:10px; padding:5px; max-width:95%;"
                                           class="btn btn-primary btn-sm" name="uimage" id="uimage" type="file"
                                           name="p4" onchange="PreviewImage();"/>

                                </div>
                            </div>

                        </div>


                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveEmployee();"><i class="fa fa-save"></i>&nbsp;Save
                    changes
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Close
                </button>

            </div>

        </div>
    </div>
</div>


</div>
</div>


<div class="modal fade" id="advanceSheet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money fa-2x"></i>&nbsp;Advance History</h4>
            </div>
            <div class="modal-body well">
                <div class="row">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Advance Date</span>
                        <input id="adate" type="text" class="form-control" placeholder="click to select date"
                               onchange="filterAdvance();">
                    </div>
                </div>
                <label class="label label-md label-default"><i class="fa fa-dashboard"></i>&nbsp;Advance history</label>
                <center>
                    <div style="border: 3px solid lightblue; height:330px; overflow-y: auto;">
                        <table class="table table-striped" id="vad">
                            <thead>
                            <th><i class="fa fa-pencil"></i>&nbsp;Sr#</th>
                            <th><i class="fa fa-money"></i>&nbsp;Advance paid</th>
                            <th><i class="fa fa-money"></i>&nbsp;Advance deduct</th>
                            <th><i class="fa fa-calendar"></i>&nbsp;Date</th>
                            <th><i class="fa fa-edit"></i>&nbsp;</th>
                            </thead>
                            <tbody id="advanceList"></tbody>
                        </table>
                    </div>
                </center>

                <div class="form-group" style="padding-top:20px;">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Total Advance</span>
                        <input type="text" class="form-control"
                               value="<?php echo "RS " . number_format($pendingadvance + $paidadvance, 2); ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Total Advance Recieved</span>
                        <input type="text" class="form-control"
                               value="<?php echo "RS " . number_format($paidadvance, 2); ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Total Advance Pending</span>
                        <input type="text" class="form-control"
                               value="<?php echo "RS " . number_format($pendingadvance, 2); ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="paymentsSheet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money fa-2x"></i>&nbsp;Payment History</h4>
            </div>
            <div class="modal-body well">
                <div class="row">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i>&nbsp;From Date#</span>
                        <input id="sfdate" type="text" placeholder="click to select date" class="form-control"
                               onchange="filterPayments();">
                        <span class="input-group-addon">  to</span>
                        <input id="stdate" type="text" placeholder="click to select date" class="form-control"
                               onchange="filterPayments();">
                    </div>
                </div>
                <label class="label label-md label-default"><i class="fa fa-dashboard"></i>&nbsp;Payment history</label>
                <center>
                    <div style="border: 3px solid lightblue; height:330px; overflow-y: auto;">
                        <table class="table table-striped" id="ssad">
                            <thead>
                            <th><i class="fa fa-pencil"></i>&nbsp;Sr#</th>
                            <th><i class="fa fa-calendar"></i>&nbsp;Date</th>
                            <th><i class="fa fa-money"></i>&nbsp;Amount</th>
                            <th><i class="fa fa-credit-card"></i>&nbsp;Amount Type</th>
                            <th><i class="fa fa-file-text"></i>&nbsp;Amount Details</th>
                            <th><i class="fa fa-edit"></i>&nbsp;</th>
                            <th><i class="fa fa-trash"></i>&nbsp;</th>
                            </thead>
                            <tbody id="paymentsList"></tbody>
                        </table>
                    </div>
                </center>

                <div class="row" style="padding-top:20px;">
                    <div class="col-md-6" style="padding-left:0px">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Total Amount Balance</span>
                            <input type="text" class="form-control"
                                   value="<?php echo "RS " . number_format($pendingpayment, 2); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding-left:0px">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Total Amount Paid</span>
                            <input type="text" class="form-control"
                                   value="<?php echo "RS " . number_format($paidAmount, 2); ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group" style="padding-top: 20px;">
                        <div class="col-md-6" style="padding-left:0px">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i>&nbsp;Date</span>
                                <input id="paymentDate" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6" style="padding-left:0px">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Amount</span>
                                <input
                                        id="pamount" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top:10px;">
                    <div class="col-md-6" style="padding-left:0px">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-credit-card"></i>&nbsp;Payment Type</span>
                            <select class="form-control" id="ptype">
                                <option>Debit</option>
                                <option>Credit</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding-left:0px">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file"></i>&nbsp;Payment Details</span>
                            <textarea id="pdetail" type="text" rows="1" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div style="padding-left:0px;">
                        <center>
                            <button class="btn btn-md btn-danger" type="button" style="margin-top:2%;"
                                    onclick="paymentPay();"><i class="fa
                        fa-plus"></i>&nbsp;
                                Add Enrty
                            </button>
                        </center>
                    </div>
                </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Close
                </button>

            </div>


        </div>
    </div>
</div>
</div>


<div class="modal fade" id="editrow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 5px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-briefcase fa-1x" tabindex="-1"></i>&nbsp;Edit
                    Item no:&nbsp;<span id="pid" style="color:red"></span>&nbsp;of&nbsp;Date:&nbsp;<span
                            style="color:blue" id="epdate"></span></h4>
            </div>
            <form>
                <div class="modal-body well">

                    <div class="row" style="margin:0px;padding:0px;">
                        <div class="panel panel-success" style="margin:0px;">
                            <div class="panel-heading" style="padding:0px; padding-left:10px;">
                                <h4 class="panel-title"><i class="fa fa-tasks"></i>&nbsp;Edit Entry</h4>
                            </div>
                            <div class="panel-body" style=" padding:0px;">
                                <table class="table table-bordered table-hover ab"
                                       style="padding:0px; margin-bottom: 0px;">
                                    <thead>
                                    <th class="text-center" style="width:40%;">
                                        <i class="fa fa-briefcase"></i>&nbsp;Product
                                    </th>
                                    <th class="text-center" style="width:20%;">
                                        <i class="fa fa-money"></i>&nbsp;@
                                    </th>
                                    <th class="text-center" style="width:20%;">
                                        <i class="fa fa-tasks"></i>&nbsp;Qty
                                    </th>
                                    <th class="text-center" style="width:20%;">
                                        <i class="fa fa-edit"></i>&nbsp;
                                    </th>
                                    </thead>
                                    <tbody>
                                    <form>
                                        <td>
                                            <select id="epname" class="form-control" placeholder='Select Product...'
                                                    tabindex="1">
                                                <?php
                                                $result = query("select p.des from product p;");
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo '<option>' . $row['des'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input class="form-control" type="number" placeholder="@" id="prate"
                                                   tabindex="2"/>
                                        </td>
                                        <td>
                                            <input class="form-control" type="number" placeholder="Unit" id="punit"
                                                   tabindex="3"/>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-md btn-warning" onclick="saveE();"
                                                    tabindex="4"><i class="fa fa-edit"></i>&nbsp;Update Entry
                                            </button>
                                        </td>
                                    </form>
                                    </tbody>

                                </table>


                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="6"><i
                                class="fa fa-remove"></i>&nbsp;Close
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="editAdrow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 5px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money fa-1x" tabindex="-1"></i>&nbsp;Edit
                    Advance no:&nbsp;<span id="adid" style="color:red"></span>&nbsp;of&nbsp;Date:&nbsp;<span
                            style="color:blue" id="addate"></span></h4>
            </div>
            <form>
                <div class="modal-body well">

                    <div class="row" style="margin:0px;padding:0px;">
                        <div class="panel panel-success" style="margin:0px;">
                            <div class="panel-heading" style="padding:0px; padding-left:10px;">
                                <h4 class="panel-title"><i class="fa fa-tasks"></i>&nbsp;Edit Advance Entry</h4>
                            </div>
                            <div class="panel-body" style=" padding:0px;">
                                <table class="table table-bordered table-hover ab"
                                       style="padding:0px; margin-bottom: 0px;">
                                    <thead>
                                    <th class="text-center">
                                        <i class="fa fa-money"></i>&nbsp;Advance Paid
                                    </th>
                                    <th class="text-center">
                                        <i class="fa fa-money"></i>&nbsp;Advance Deduct
                                    </th>
                                    <th class="text-center">
                                        <i class="fa fa-edit"></i>&nbsp;
                                    </th>
                                    </thead>
                                    <tbody>
                                    <form>
                                        <td>
                                            <input class="form-control" type="text" placeholder="Advance Paid" id="adad"
                                                   tabindex="1"/>
                                        </td>
                                        <td>
                                            <input class="form-control" type="number" placeholder="Advance Deduct"
                                                   id="addad" tabindex="2"/>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-md btn-warning" onclick="editA();"
                                                    tabindex="3"><i class="fa fa-edit"></i>&nbsp;Update Entry
                                            </button>
                                        </td>
                                    </form>
                                    </tbody>

                                </table>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="4"><i
                                class="fa fa-remove"></i>&nbsp;Close
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="editprow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 5px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money fa-1x" tabindex="-1"></i>&nbsp;Edit
                    Payment no:&nbsp;<span id="payid" style="color:red"></span>&nbsp;of&nbsp;Date:&nbsp;<span
                            style="color:blue" id="paydate"></span></h4>
            </div>
            <form>
                <div class="modal-body well">

                    <div class="row" style="margin:0px;padding:0px;">
                        <div class="panel panel-success" style="margin:0px;">
                            <div class="panel-heading" style="padding:0px; padding-left:10px;">
                                <h4 class="panel-title"><i class="fa fa-tasks"></i>&nbsp;Edit Payment Entry</h4>
                            </div>
                            <div class="panel-body" style=" padding:0px;">
                                <table class="table table-bordered table-hover ab"
                                       style="padding:0px; margin-bottom: 0px;">
                                    <thead>
                                    <th class="text-center">
                                        <i class="fa fa-money"></i>&nbsp;Payment Paid
                                    </th>
                                    <th class="text-center">
                                        <i class="fa fa-tags"></i>&nbsp;Payment Type
                                    </th>
                                    <th class="text-center">
                                        <i class="fa fa-file-text"></i>&nbsp;Detail
                                    </th>
                                    <th class="text-center">
                                        <i class="fa fa-edit"></i>&nbsp;
                                    </th>
                                    </thead>
                                    <tbody>
                                    <form>
                                        <td>
                                            <input class="form-control" type="text" placeholder="Payment Paid"
                                                   id="ppaid" tabindex="1"/>
                                        </td>
                                        <td>
                                            <select class="form-control" type="text" id="pptype" tabindex="2">
                                                <option>Debit</option>
                                                <option>Credit</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" placeholder="Payment Detail"
                                                   id="ppdetail" tabindex="3"/>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-md btn-warning" onclick="editpay();"
                                                    tabindex="5"><i class="fa fa-edit"></i>&nbsp;Update Entry
                                            </button>
                                        </td>
                                    </form>
                                    </tbody>

                                </table>


                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" tabindex=6"><i
                                class="fa fa-remove"></i>&nbsp;Close
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>


<script src="js/jquery.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/taffy-min.js"></script>
<script src="js/jquery.json-2.4.min.js"></script>
<script src="js/showVendor.js"></script>
<script src="js/datepicker.js"></script>
<script type="text/javascript">
    // When the document is ready
    $(document).ready(function () {

        $('#adate').datepicker({
            format: "dd-mm-yyyy"
        });
        $('#stdate').datepicker({
            format: "dd-mm-yyyy"
        });
        $('#sfdate').datepicker({
            format: "dd-mm-yyyy"
        });
        $('#fdate').datepicker({
            format: "dd-mm-yyyy"
        });
        $('#tdate').datepicker({
            format: "dd-mm-yyyy"
        });
        $('#paymentDate').datepicker({
            format: "dd-mm-yyyy"
        });
        $('#paymentDate').datepicker('setValue', 'gotoCurrent');
        var d = new Date();
        $('#npdate').val((d.getMonth() + 1) + "-" + d.getDate() + "-" + d.getFullYear());

    });
</script>
