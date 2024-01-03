<?php
setlocale(LC_MONETARY, "en_US");
$cid = $_GET["idno"];
$result = query("select * from customer where id='$cid'");
$customer_row = "";
while ($row = mysqli_fetch_array($result)) {
    $customer_row = $row;
    $address = $row['address'];
    $name = $row['name'];
    $phone = $row['phone'];
    $email = $row['email'];
    $company = $row['company'];
    $city = $row['city'];
    $opening_balance = $row['openingbalance'];
}

$result = query("select sum(amount) as amountReceived from customerpayments where cid='$cid' and ptype='Credit'");
while ($row = mysqli_fetch_array($result)) {
    $amountReceived = ($row['amountReceived']);
}

$result = query("select sum(amount) as charge from customerpayments where cid='$cid' and ptype='Debit'");
while ($row = mysqli_fetch_array($result)) {
    $charge = ($row['charge']);
}


$result = query("Select (SELECT sum(ba.amount) from billamounts ba,bill b WHERE ba.bid=b.id and b.cid='$cid' ) tpaid,count(*) tb,sum(amount-discount) tamount  from bill b where b.type='Invoice' and b.cid='$cid'");
if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        $tbills = $row['tb'];
        $tamount = $row['tamount'];
        $tpaid = $row['tpaid'];

    }
    $tbalance = $tamount - $tpaid + $opening_balance - $amountReceived+$charge;

} else {
    $tbills = 0;
    $tamount = 0;
    $tpaid = 0;
    $tbalance = 0;
}

?>

<input id="userRole" value="<?php echo $_SESSION['role'];?>" style="display: none;">

<div class="page-content">

    <!-- Page Heading -->
    <div class="row" style="padding-left: 15px;">
        <div class="btn-group btn-breadcrumb">
            <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
            <a href="index.php?page=customers" class="btn btn-default"><i class="fa fa-group"></i>&nbsp;Customers</a>
            <a href="#" class="btn btn-primary"><i class="fa fa-user"></i>&nbsp;Customer Details</a>
        </div>
    </div>

</div>

<!--
<div class="row" style="padding:20px">
    <div class="col-md-6" >
    <a href="#"  class="btn btn-md btn-warning"   data-toggle="modal" data-target="#PayModal"    onclick="clearModal();"  style="font-size:15px;">
            <i class="fa fa-money"></i>
        
            <b> Pay Amount</b> </a>
    <a class="btn btn-md btn-danger"  style="font-size:15px;" onclick="deleteBill(<?php echo $cid; ?>);">

            <i class="fa fa-remove"></i>
            <b>Delete Bill</b></a>
</div>      
   
    
</div>              
</div>                /.row -->


<div class="row" style="padding-left:15px; padding-right:15px;">
    <div class="col-lg-6" style="padding-left:0px; ">
        <div class="panel panel-info" style="margin-top:10px;">

            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i><b>&nbsp;Customer Detail:</b></h3>
                <span id="cid" style="display: none;"><?php echo $cid; ?></span>
                <?php if ($cid != 1 && $_SESSION['role'] == "Admin")
                    echo '<a onclick="deleteCustomer(' . $cid . ')" class="btn btn-sm btn-danger" style="float:right; margin-top:20px; margin-bottom:5px;"><i class="fa fa-trash"></i>&nbsp;Delete</a><a class="btn btn-sm btn-primary" onclick="loadData();" data-toggle="modal" data-target="#CustomerModal" style="float:right; margin-top:20px; margin-bottom:5px; margin-right:5px;"><i class="fa fa-edit"></i>&nbsp;Edit</a>'; ?>
            </div>

            <div class="panel-body">
                <table class="table table-bordered" style="padding:0px;">
                    <tbody id="tocustomer">
                    <tr>
                        <td class="nocenter">
                            <b>Customer# </b> <span id="customer_no"><?php echo $customer_row['customer_no']; ?></span>
                        </td>
                        <td class="nocenter"><i class="fa fa-user"></i>&nbsp;<b>Name:</b> <span id="name"><?php echo $name; ?></span></td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-globe"></i>&nbsp;<b>Email:</b> <span id="email"><?php echo $email; ?></span></td>
                        <td class="nocenter"><i class="fa fa-home"></i>&nbsp;<b>Company:</b> <span id="company"><?php echo $company;
                                ?></span></td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-building"></i>&nbsp;<b>Country: </b><span id="country"><?php  echo $customer_row['country'];
                                ?></span></td>
                        <td class="nocenter"><i class="fa fa-building"></i>&nbsp;<b>City: </b><span id="city"><?php echo $city;
                                ?></span></td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-phone"></i>&nbsp;<b>Phone: </b><span id="phone"><?php  echo $customer_row['phone'];
                                ?></span></td>
                        <td class="nocenter"><i class="fa fa-phone-square"></i>&nbsp;<b>Telephone: </b><span id="telephone"><?php  echo $customer_row['telephone'];
                                ?></span></td>
                    </tr>
                    <tr>
                        <td class="nocenter"><b>UID # </b><span id="uid_no"><?php  echo $customer_row['uid_no'];
                                ?></span></td>
                        <td class="nocenter"><b>Account # </b><span id="account_no"><?php  echo $customer_row['account_no'];
                                ?></span></td>
                    </tr>
                    <tr>
                        <td class="nocenter"><b>Zipcode # </b><span id="zip_code"><?php  echo $customer_row['zip_code'];
                                ?></span></td>
                        <td class="nocenter"><b>GST % </b><span id="gst"><?php  echo $customer_row['gst'];
                                ?></span></td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-book"></i>&nbsp;<b>Address:</b><span id="address"><?php echo
                                $address;
                                ?></span></td>
                        <td class="nocenter"><i class="fa fa-money"></i>&nbsp;<b>Opening Balance:</b> <span
                                id="opening_balance"><?php echo $opening_balance; ?></span></td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="col-lg-5 col-lg-offset-1" style="padding-left:0px; ">
        <div class="panel panel-info" style="margin-top:0px;">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money"></i><b>&nbsp;Payment &amp; Bills Detail:</b></h3>
                <span id="cid" style="display: none;"><?php echo $cid; ?></span>
                <?php if ($cid != 1) {
                    echo '<a class="btn btn-md btn-warning" data-toggle="modal" data-target="#paymentsSheet" style="float:right; margin-top:20px; margin-bottom:5px; margin-right:5px;" onclick="loadPayments();"><i class="fa fa-money"></i>&nbsp;Payments sheet</a>';
                }
                ?>
            </div>
            <div class="panel-body">
                <table class="table table-bordered" style="padding:0px;margin-top:5px;">
                    <tbody id="tocustomer">
                    <tr>
                        <td class="nocenter">
                            <i class="fa fa-file-text"></i>&nbsp;<b>Total Bills: </b>
                            <?php echo number_format($tbills); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-money"></i>&nbsp;<b>Total Amount:</b>
                            <?php echo CURRENCY_SIGN.' '. number_format($tamount+$charge, 2); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-money"></i>&nbsp;<b>Total Amount Recieved:</b>
                            <?php echo CURRENCY_SIGN.' '. number_format($tpaid+$amountReceived, 2); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-money"></i>&nbsp;<b>Total Balance:</b>
                            <?php echo CURRENCY_SIGN.' '. number_format($tbalance, 2); ?>
                        </td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<div class="row" style="padding-left:15px; padding-right:15px;">
    <div class="col-md-3" style="padding:0px;">

        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Bill no#</span>
            <input id="billno" type="number" class="form-control" onkeyup="filter();">
        </div>
    </div>
    <div class="col-md-9" style="padding-left:5px;">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i>&nbsp;From Date#</span>
            <input id="fdate" type="text" placeholder="click to select date" class="form-control" onchange="filter();">
            <span class="input-group-addon">  to</span>
            <input id="tdate" placeholder="click to select date" type="text" class="form-control" onchange="filter();">
        </div>
    </div>
</div>
<div class="row" style="padding-left:15px; padding-right:15px;">
    <div class="panel panel-info" style="margin-top:10px;">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-file-text"></i><b>&nbsp;Customer Bills</b></h3>
        </div>
        <div class="panel-body" style="height:385px; overflow-y:auto; padding:0px">
            <div class="row">
                <table class="table table-bordered table-hover" style="padding:0px;">
                    <thead>
                    <th class="text-center">
                        <i class="fa fa-file"></i>&nbsp;Bill no#
                    </th>
                    <th class="text-center">
                        <i class="fa fa-user"></i>&nbsp;Customer
                    </th>
                    <th class="text-center">
                        <i class="fa fa-money"></i>&nbsp;Total Amount
                    </th>
                    <th class="text-center">
                        <i class="fa fa-money"></i>&nbsp;Amount Recieved
                    </th>
                    <th class="text-center">
                        <i class="fa fa-money"></i>&nbsp;Balance
                    </th>
                    <th class="text-center">
                        <i class="fa fa-calendar"></i>&nbsp;Date
                    </th>
                    <th class="text-center">
                        <i class="fa fa-calendar"></i>&nbsp;Due by
                    </th>
                    <th class="text-center">
                        <i class="fa fa-file-text-o"></i>&nbsp;Bill Type
                    </th>
                    </thead>
                    <tbody id="bills">

                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>
</div>


<div class="modal fade" id="PayModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel"><i class="fa fa-money fa-2x"></i> Pay Amount</h3>
            </div>
            <div class="modal-body">
                <center>
                    <form>
                        <div class="row" style="padding:10px; margin-left:17%;">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">Previous Balance:</span>
                                        <input type="text" id="pbalance" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding:10px; margin-left:17%;">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">Amount Paid:</span>
                                        <input type="number" id="amountp" class="form-control" onkeyup="calBalance();" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding:10px; margin-left:17%;">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <span class="input-group-addon">Remaining Balance:</span>
                                        <input type="text" id="rbalance" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="payAmount();">Save Changes</button>
                <!--                    <button type="button" class="btn btn-primary" onclick="payAmountSlip();">Save &amp; PrintSlip</button>-->
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>


</div>


<div class="modal fade" id="CustomerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user fa-2x"></i> Edit Customer Details</h4>
            </div>
            <div class="modal-body well">
                <form>
                    <div class="row">
                        <div class="form-group" style="padding-top: 10px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                                class="fa fa-money"></i>&nbsp;Opening Balance</span>
                                    <input id="copening_balance" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" style="padding-top: 10px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="fa fa-hashtag"></i>&nbsp;Customer #</span>
                                    <input type="text" id="ccustomer_no" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i>&nbsp;Name</span>
                                    <input type="text" id="cname" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group" style="padding-top: 10px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-globe"></i>&nbsp;Email</span>
                                    <input id="cemail" type="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="fa fa-home"></i>&nbsp;Company Name</span>
                                    <input id="ccompany" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group" style="padding-top: 10px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="fa fa-building"></i>&nbsp;Country</span>
                                    <select id="ccountry" name="ccountry" class="selectpicker show-tick"
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
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-building"></i>&nbsp;City</span>
                                    <input id="ccity" name="ccity" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group" style="padding-top: 10px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i>&nbsp;Phone</span>
                                    <input id="cphone" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="fa fa-money"></i>&nbsp;Telephone</span>
                                    <input id="ctelephone" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group" style="padding-top: 10px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="fa fa-hashtag"></i>&nbsp;UID No.</span>
                                    <input id="cuid_no" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="fa fa-hashtag"></i>&nbsp;Account No</span>
                                    <input id="caccount_no" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group" style="padding-top: 10px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="fa fa-hashtag"></i>&nbsp;Zip Code</span>
                                    <input id="czip_code" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-hashtag"></i>&nbsp;GST %</span>
                                    <input id="cgst" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group" style="padding-top: 10px;">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-book"></i>&nbsp;Address</span>
                                    <textarea id="caddress" type="text" class="form-control" rows="2"
                                              cols="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="updateCustomer();"><i class="fa fa-save"></i>&nbsp;Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Close</button>

            </div>
        </div>
    </div>
</div>


<!--//Payment Sheet-->
<div class="modal fade" id="paymentsSheet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                        <input id="sfdate" type="text" placeholder="click to select date" class="form-control" onchange="filterPayments();">
                        <span class="input-group-addon">  to</span>
                        <input id="stdate" type="text" placeholder="click to select date" class="form-control" onchange="filterPayments();">
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
                            <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Total Amount Received</span>
                            <input type="text" class="form-control" value="<?php echo CURRENCY_SIGN.' '. number_format($tpaid+$amountReceived, 2); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding-left:0px">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Total Amount Balance</span>
                            <input type="text" class="form-control" value="<?php echo CURRENCY_SIGN.' '. number_format($tbalance, 2); ?>" readonly>
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
                                <option>Credit</option>
                                <option>Debit</option>
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
                            <button class="btn btn-md btn-danger" type="button" style="margin-top:2%;" onclick="customerPayment();"><i class="fa
                        fa-plus"></i>&nbsp;
                                Add Enrty
                            </button>
                        </center>
                    </div>
                </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Close</button>

            </div>


        </div>
    </div>
</div>
</div>





<div class="modal fade" id="editprow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 5px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money fa-1x" tabindex="-1"></i>&nbsp;Edit Payment no:&nbsp;<span id="payid" style="color:red"></span>&nbsp;of&nbsp;Date:&nbsp;<span style="color:blue" id="paydate"></span></h4>
            </div>
            <form>
                <div class="modal-body well">

                    <div class="row" style="margin:0px;padding:0px;">
                        <div class="panel panel-success" style="margin:0px;">
                            <div class="panel-heading" style="padding:0px; padding-left:10px;">
                                <h4 class="panel-title"><i class="fa fa-tasks"></i>&nbsp;Edit Payment Entry</h4>
                            </div>
                            <div class="panel-body" style=" padding:0px;">
                                <table class="table table-bordered table-hover ab" style="padding:0px; margin-bottom: 0px;">
                                    <thead>
                                    <th class="text-center">
                                        <i class="fa fa-money"></i>&nbsp;Payment Received
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
                                    <tbody><form>
                                        <td>
                                            <input class="form-control" type="text" placeholder="Payment Received" id="ppaid" tabindex="1" />
                                        </td>
                                        <td>
                                            <select class="form-control" type="text" id="pptype" tabindex="2" >
                                                <option>Credit</option>
                                                <option>Debit</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" placeholder="Payment Detail" id="ppdetail" tabindex="3" />
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-md btn-warning" onclick="editpay();" tabindex="5"><i class="fa fa-edit"></i>&nbsp;Update Entry</button>
                                        </td>
                                    </form>
                                    </tbody>

                                </table>



                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" tabindex=6"><i class="fa fa-remove"></i>&nbsp;Close</button>

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
<script src="js/showCustomer.js"></script>
<script src="js/datepicker.js"></script>


<script type="text/javascript">
    // When the document is ready
    $(document).ready(function () {

        $('#tdate').datepicker({
            format: "dd-mm-yyyy"
        });
        $('#fdate').datepicker({
            format: "dd-mm-yyyy"
        });

        $('#stdate').datepicker({
            format: "dd-mm-yyyy"
        });
        $('#sfdate').datepicker({
            format: "dd-mm-yyyy"
        });

        $('#paymentDate').datepicker({
            format: "dd-mm-yyyy"
        });

        $('#paymentDate').datepicker('setValue','gotoCurrent');

    });
</script>
    