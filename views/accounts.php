<style>
.ab > thead > tr > th, .ab > tbody > tr > th, .ab > tfoot > tr > th, .ab > thead > tr > td, .ab > tbody > tr > td, .ab > tfoot > tr > td {
    padding:2px;
</style>

<div class="container-fluid">
    <div class="page-content">
        <!-- Page Heading -->


        <div class="row">
            <div class="col-md-2" style="padding:0px;">
                <div class="btn-group btn-breadcrumb">
                    <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                    <a href="#" class="btn btn-primary"><i class="fa fa-dollar"></i>&nbsp;Accounts</a>
                </div>
            </div>
            <div class="col-md-10">
                <div style="margin-bottom:10px; padding:5px;">

                    <a href="" class="btn btn-md btn-warning" style="float:right; margin:5px; margin-bottom:0px;" data-toggle="modal" data-target="#newAccountHead" onclick="">
                        <i class="fa fa-bars"></i>&nbsp;New Account Head</a>

                    <a href="#" class="btn btn-md btn-success" style="float:right; margin:5px; margin-bottom:0px;" data-toggle="modal" data-target="#newAccountModal" onclick="clearModal();">
                        <i class="fa fa-plus"></i>&nbsp;New Account</a>
                    <a href="" class="btn btn-md btn-danger" style="float:right; margin:5px; margin-bottom:0px;" data-toggle="modal" data-target="#newAccountVoucher" onclick="">
                        <i class="fa fa-file-text"></i>&nbsp;New Voucher</a>
                     <a href="" class="btn btn-md btn-danger" style="float:right; margin:5px; margin-bottom:0px;" data-toggle="modal" data-target="#newPaymentVoucher" onclick="">
                    <i class="fa fa-file-text"></i>&nbsp;New Vendor Voucher</a>    
                    <a href="index.php?page=vendors" class="btn btn-md btn-primary" style="float:right; margin:5px; margin-bottom:0px;">
                        <i class="fa fa-group"></i>&nbsp;Vendors</a>
                    <a href="index.php?page=daybook" class="btn btn-md btn-info" style="float:right; margin:5px; margin-bottom:0px;">
                        <i class="fa fa-book"></i>&nbsp;Day Book</a>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:20px;">
            <div class="col-md-3" style="padding:0px;">

                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Account Sr#</span>
                    <input id="aid" type="number" class="form-control" onkeyup="filter();">
                </div>
            </div>
            <div class="col-md-5" style="padding-left:2px; padding-right:2px;">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Account Type#</span>
                    <select id="btype" class="selectpicker show-tick" data-live-search="true" title='Select Type...' onchange="filter();">
                        <option class="btn-success">Show all</option>
                        <?php $result=query( "select typename from accounttypes"); while($row=mysqli_fetch_array($result)) { echo '<option>'.$row[ 'typename']. '</option>'; } ?>
                    </select>


                </div>
            </div>
        </div>
        <!-- /.row -->




        <div class="panel panel-default" style="margin-top:10px;">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bank"></i><span class="break"></span>&nbsp;Company Accounts</h3>
            </div>
            <div class="panel-body" style="height:370px; overflow-y:auto; padding:0px;">
                <div class="row">
                    <table class="table table-bordered table-hover" style="padding:0px;">
                        <thead>
                            <th class="text-center">
                                <i class="fa fa-pencil"></i>&nbsp;Account Sr#
                            </th>
                            <th class="text-center">
                                <i class="fa fa-barcode"></i>&nbsp;Account Code
                            </th>
                            <th class="text-center">
                                <i class="fa fa-tasks"></i>&nbsp;Account Type
                            </th>
                            <th class="text-center">
                                <i class="fa fa-money"></i>&nbsp;Currency
                            </th>
                        </thead>
                        <tbody id="accounts">
                        </tbody>
                    </table>


                </div>
            </div>
        </div>

    </div>





</div>
</div>
<style>
    .row {
        padding-bottom: 10px;
    }

</style>

<div class="modal fade" id="newAccountModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bank fa-2x"></i>&nbsp;New Account</h4>
            </div>
            <div class="modal-body well">
                <form id="accountform">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil"></i>&nbsp;Account code</span>
                                <input name="acc_code" id="acc_code" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tasks"></i>&nbsp;Account Type</span>
                                <select name="acc_type" id="acc_type" class="form-control" required>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;CurrencyCode</span>
                                <select name="acc_currency" id="acc_currency" class="form-control" required>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-folder-open"></i>&nbsp;Account Opening Balance</span>
                                <input name="openingbalance" id="openingbalance" type="text" class="form-control" required>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveAccount();"><i class="fa fa-save"></i>&nbsp;Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Close</button>

            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="newAccountHead" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bank fa-2x"></i>&nbsp;New Account Head</h4>
            </div>
            <div class="modal-body well">
                <form id="accountform">
                    <div class="row">
                        <div class="col-md-6" style="padding-left:0px;">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-bars"></i>&nbsp;Head Name</span>
                                <input name="hname" id="hname" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding-left:0px;">
                            <div class="input-group">
                                <button type="button" class="btn btn-primary" onclick="saveHead();"><i class="fa fa-plus"></i>&nbsp;Add</button>
                            </div>
                        </div>
                    </div>
                    <label class="label label-md label-default"><i class="fa fa-dashboard"></i>&nbsp;Account heads</label>
                    <center>
                        <div style="border: 1px solid lightblue; height:350px; overflow-y: auto;">
                            <table class="table table-striped" id="accountH">
                                <thead>
                                    <th><i class="fa fa-pencil"></i>&nbsp;Sr#</th>
                                    <th><i class="fa fa-tag"></i>&nbsp;Head name</th>
                                    <th><i class="fa fa-trash"></i>&nbsp;</th>
                                </thead>
                                <tbody>
                                    <?php
                                $result=query("select * from accounttypes;");
                                    while($row=mysqli_fetch_array($result))
                                    {
                                        if($row['typename']=="BANK")
                                        echo '<tr><td>'.$row['id'].'</td><td>'.$row['typename'].'</td><td><a class="btn btn-sm btn-danger"   disabled><i class="fa fa-trash"></i>&nbsp;Delete</a></td></tr>';
                                        else
                                        echo '<tr><td>'.$row['id'].'</td><td>'.$row['typename'].'</td><td><a class="btn btn-sm btn-danger" onclick="deleteArow(this);"><i class="fa fa-trash"></i>&nbsp;Delete</a></td></tr>';
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </center>



                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Close</button>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="newAccountVoucher" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding-bottom: 0px;padding-top: 0px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>


                <div class="row">
                    <div class="col-md-6">
                        <h4 class="modal-title" id="myModalLabel" style="padding-top: 25px;"><i class="fa fa-file-text fa-1x"></i>&nbsp;New
                            Account Voucher&nbsp;</h4>
                    </div><div class="col-md-6" style="padding-right: 25px;">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa  fa-calendar"></i>&nbsp;Voucher Date#</span><input id="avdate" class="form-control input-sm"  type="text"/></span>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-body well">
                <form id="accountform">
                    <div class="row" style="margin:0px;padding:0px;">
                        <div class="panel panel-success" style="margin:0px;">
                            <div class="panel-heading" style="padding:0px; padding-left:10px;">
                                <h4 class="panel-title"><i class="fa fa-tasks"></i>&nbsp; New Entry</h4>
                            </div>
                            <div class="panel-body" style=" padding:0px;">
                                <table class="table table-bordered table-hover ab" style="padding:0px; margin-bottom: 0px;">
                                    <thead>
                                    <th class="text-center">
                                        <i class="fa fa-tag"></i>&nbsp;Account
                                    </th>
                                    <th class="text-center">
                                        <i class="fa fa-file-text"></i>&nbsp;Discription
                                    </th>
                                    <th class="text-center">
                                        <i class="fa fa-upload"></i>&nbsp;Paid
                                    </th>
                                    <th class="text-center">
                                        <i class="fa fa-download"></i>&nbsp;Recieved
                                    </th>
                                    <th class="text-center">
                                        <i class="fa fa-plus"></i>&nbsp;
                                    </th>
                                    </thead>
                                    <tbody><form>
                                        <td>
                                            <select id="vatype" class="selectpicker show-tick" onfocus="this.selectedIndex = -1;" data-live-search="true" title='Select Type...' tabindex="1">
                                                <?php
                                                $result=query( "select concat('(',a.id,') ',a.code,': ',ac.typename) as name,a.id from account a,accounttypes ac where a.type=ac.id;"); while($row=mysqli_fetch_array($result)) { echo '<option value='.$row[ 'id'].'>'.$row[ 'name']. '</option>'; } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" placeholder="Dicription" id="vdis" tabindex="2" />
                                        </td>
                                        <td>
                                            <input class="form-control" type="number" placeholder="Paid" id="vpaid" tabindex="3" />
                                        </td>
                                        <td>
                                            <input class="form-control" type="number" placeholder="Recieved" id="vreceived" tabindex="4"  />
                                        </td>
                                        <td>
                                            <button type="button" id="btn_e" class="btn btn-md btn-warning" onclick="saveV();"  tabindex="5"><i class="fa fa-plus"></i>&nbsp;Add Entry</button>
                                        </td>
                                    </form>
                                    </tbody>

                                </table>



                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin:0px;padding:0px;">
                        <div class="panel panel-success" style="margin-top:10px;">
                            <div class="panel-body" style=" padding:0px;   height:330px; overflow-y: auto;">
                                <table class="table table-bordered table-hover ab" id="ava" style="padding:0px; margin-bottom: 0px;">
                                    <thead>
                                    <th class="text-tag">
                                        <i class="fa fa-tag"></i>&nbsp;Trx Sr#
                                    </th>
                                    <th class="text-center">
                                        <i class="fa fa-tasks"></i>&nbsp;Account
                                    </th>
                                    <th class="text-center">
                                        <i class="fa fa-file-text"></i>&nbsp;Discription
                                    </th>
                                    <th class="text-center">
                                        <i class="fa fa-upload"></i>&nbsp;Paid
                                    </th>
                                    <th class="text-center">
                                        <i class="fa fa-download"></i>&nbsp;Recieved
                                    </th>
                                    <th class="text-center">
                                        <i class="fa fa-trash"></i>&nbsp;
                                    </th>
                                    </thead>
                                    <tbody id='avoucher'>

                                    </tbody>

                                </table>



                            </div>
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


<div class="modal fade" id="newPaymentVoucher" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 5px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-text fa-1x" tabindex="-1"></i>&nbsp;Payment Voucher no:&nbsp;<span style="color:red" ><?php
                        $result = query("select max(vno) bno from vendorpurchase");
                        $data = mysqli_fetch_assoc($result);
                        $next_increment = $data['bno'];
                        echo ($next_increment+1);
                        ?>
                        <input type="number" id="bno" style="display: none;" value="<?php echo $next_increment+1; ?>"></span>&nbsp;&nbsp;Date:&nbsp;<span style="color:blue"><?php echo date("F j, Y, g:i a");  ?></span></h4>
            </div>
            <div class="modal-body well">
                <form id="accountform">
                    <div class="row">
                        <div class="col-md-6" style="padding-left:0px; padding-bottom:3px;">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Vendor ID#</span>
                                <select id="vid" class="selectpicker show-tick" data-live-search="true" title="Enter Vendor Name.." onchange="getVendorData();">
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
                                <span class="input-group-addon"><i class="fa  fa-calendar"></i>&nbsp;Voucher Date#</span>
                                <input id="vdate" class="form-control"  type="text"/>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin:0px;padding:0px;">
                        <div class="panel panel-success" style="margin:0px;">
                            <div class="panel-heading" style="padding:0px; padding-left:10px;">
                                <h4 class="panel-title"><i class="fa fa-tasks"></i>&nbsp; New Entry</h4>
                            </div>
                            <div class="panel-body" style=" padding:0px;">
                                <table class="table table-bordered table-hover ab" style="padding:0px; margin-bottom: 0px;">
                                    <thead>
                                        <th class="text-center" style="width:406px;">
                                            <i class="fa fa-briefcase"></i>&nbsp;Product
                                        </th>
                                        <th class="text-center">
                                            <i class="fa fa-money"></i>&nbsp;@
                                        </th>
                                        <th class="text-center">
                                            <i class="fa fa-tasks"></i>&nbsp;Qty
                                        </th>
                                        <th class="text-center">
                                            <i class="fa fa-plus"></i>&nbsp;
                                        </th>
                                    </thead>
                                    <tbody>
                                        <form>
                                            <td>
                                            <select id="vproduct" class="form-control" title='Select Product...' tabindex="2" onchange="loadProductDetail();">
                                            </select>
                                                        
                                            </td>
                                            <td>
                                                <input class="form-control" type="number" placeholder="@" id="vrate" tabindex="3" />
                                            </td>
                                            <td>
                                                <input class="form-control" type="number" placeholder="Qty" id="vqty" tabindex="4" />
                                            </td>
                                            <td>
                                                <button type="button" id="entry" class="btn btn-md btn-warning" onclick="saveVo();" tabindex="5"><i class="fa fa-plus"></i>&nbsp;Add Entry</button>
                                            </td>
                                        </form>
                                    </tbody>

                                </table>



                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin:0px;padding:0px;">
                        <div class="panel panel-success" style="margin-top:10px; margin-bottom: 0px;">
                            <div class="panel-body" style=" padding:0px;   height:300px; overflow-y: auto;">
                                <table class="table table-bordered table-hover ab" id="ava" style="padding:0px; margin-bottom: 0px;">
                                    <thead>
                                        <th class="text-tag">
                                            <i class="fa fa-tag"></i>&nbsp;id
                                        </th>
                                        <th class="text-center">
                                            <i class="fa fa-briefcase"></i>&nbsp;Product
                                        </th>
                                        <th class="text-center">
                                            <i class="fa fa-money"></i>&nbsp;@
                                        </th>
                                        <th class="text-center">
                                            <i class="fa fa-tasks"></i>&nbsp;Qty
                                        </th>
                                        <th class="text-center">
                                            <i class="fa fa-money"></i>&nbsp;Amount
                                        </th>
                                        <th class="text-center">
                                            <i class="fa fa-trash"></i>&nbsp;
                                        </th>
                                    </thead>
                                    <tbody id='vendorvoucher'></tbody>

                                </table>



                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4" style="padding-left:0px;padding-right:5px;">
                            <div style="padding-top:5px; padding-left:0px; padding-right:0px;">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Total Payment</span>
                                    <input id="totalpayment" type="text" class="form-control" readonly tabindex="-1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style=" padding-left:0px;padding-right:5px;">
                            <div style="padding-top:5px; padding-left:0px; padding-right:0px;">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Payment Balance</span>
                                    <input id="ppayment" type="text" class="form-control" readonly tabindex="-1" />
                                </div>
                            </div>
                        </div>
<!--                        <div class="col-md-4" style="padding-right:0px; padding-left:0px;">-->
<!--                            <div style="padding-top:5px; padding-left:0px;  padding-right:0px;">-->
<!--                                <div class="input-group">-->
<!--                                    <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Advance Balance</span>-->
<!--                                    <input id="padvance" type="text" class="form-control" readonly tabindex="-1" />-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div class="col-md-4" style="padding-left:0px;padding-right:5px;">
                            <div style="padding-top:5px; padding-left:0px; padding-right:0px;">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Payment Pay</span>
                                    <input id="vpayment" type="number" class="form-control" onkeyup="calpay();" />
                                </div>
                            </div>
                    </div>
<!--                        <div class="col-md-4" style="padding-left:0px;padding-right:5px;">-->
<!--                            <div style="padding-top:5px; padding-left:0px; padding-right:0px;">-->
<!--                                <div class="input-group">-->
<!--                                    <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Advance Pay</span>-->
<!--                                    <input id="vad" type="number" class="form-control" onkeyup="calpay();" />-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-4" style="padding-left:0px;padding-right:0px;">-->
<!--                            <div style="padding-top:5px; padding-left:0px; padding-right:0px;">-->
<!--                                <div class="input-group">-->
<!--                                    <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;Advance Deduct</span>-->
<!--                                    <input id="vdad" type="number" class="form-control" onkeyup="calpay();" />-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->

                    </div>
                    <div class="row">
                        <div class="col-md-6" style="padding-left:0px;">
                            <div style="padding-top:5px; padding-left:0px; padding-right:0px;">
                                <div class="input-group">
                                    <span class="input-group-addon green"><i class="fa fa-money"></i>&nbsp;Final Payment</span>
                                    <input id="fpay" type="text" class="form-control" readonly tabindex="-1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding-left:0px">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-credit-card"></i>&nbsp;Payment Type</span>
                                <select class="form-control" id="ptype" >
                                    <option>Debit</option>
                                    <option>Credit</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row" style="padding-top:10px;">
                        <div class="col-md-6" style="padding-left:0px" >
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-file"></i>&nbsp;Payment Details</span>
                                <textarea id="pdetail" type="text"  class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveVendorVoucher();"><i class="fa fa-save"></i>&nbsp;Save changes</button>
                <button type="button" id="btn_close" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Close</button>

            </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->
<!-- /#page-wrapper 
    <!-- /#wrapper -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/taffy-min.js"></script>
<script src="js/jquery.json-2.4.min.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="js/datepicker.js"></script>
<script src="js/accounts.js">
</script>
<script>

    $('#vdate').datepicker({
        format: "dd-mm-yyyy"
    });
    $('#vdate').datepicker('setValue','gotoCurrent');

    $('#avdate').datepicker({
        format: "dd-mm-yyyy"
    });
    $('#avdate').datepicker('setValue','gotoCurrent');
</script>