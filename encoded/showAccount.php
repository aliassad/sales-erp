<?php
setlocale(LC_MONETARY,"en_US");
$id=$_GET["Accountno"];
$result=query("SELECT a.id,a.code as accode,a.openingbalance,(select at.typename from accounttypes at where a.type=at.id or at.id is null ) as typename,ac.code from account a,accountcurrency ac WHERE  a.currency=ac.id and a.id='$id'");
while($row=mysqli_fetch_array($result))
{
$id=$row["id"];
$acode=$row["accode"];
$atype=$row["typename"];
$acurrency=$row["code"];
$obalance=$row["openingbalance"];

  
}

$result=query("SELECT sum(t.credit),sum(t.debit) from accounttransaction t where t.aid='$id'");
while($row=mysqli_fetch_array($result))
{
   $totalCredit=$row["sum(t.credit)"];
   $totalDebit=$row["sum(t.debit)"];
}

if(strtolower($atype)=='bank')
$totalBalance=($obalance+$totalCredit)-$totalDebit;
else
    $totalBalance=($obalance+$totalDebit)-$totalCredit;
//
//$result=query("select sum(amount) amount from employeeadvance where eid='$eid' and type='P'");
//while($row=mysqli_fetch_array($result))
//{
//    $peadvance=$row['amount'];
//}
//
//$result=query("select sum(amount) amount from employeeadvance where eid='$eid' and type='D'");
//while($row=mysqli_fetch_array($result))
//{
//    $paidadvance=$row['amount'];
//}


?>
<input id="userRole" value="<?php echo $_SESSION['role'];?>" style="display: none;">
    <div class="page-content">

        <!-- Page Heading -->


        <div class="row">
            <div class="btn-group btn-breadcrumb">
                <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                <a href="index.php?page=accounts" class="btn btn-default"><i class="fa fa-dollar"></i>&nbsp;Accounts</a>
                <a href="#" class="btn btn-primary"><i class="fa fa-bank"></i>&nbsp;Account Details</a>
            </div>
        </div>





        <div class="row">
            <div class="col-md-6" style="padding-right:30px; padding-left:0px;">
                <div class="panel panel-info" style="margin-top:10px;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bank"></i><b>&nbsp;Account Details:</b></h3>
                        <span id="a" style="display: none;"><?php echo $id; ?></span>

                        <?php if($_SESSION['role']=="Admin"){?>
                        <a onclick="deleteAccount(<?php echo $id; ?>)" class="btn btn-md btn-danger" style="float:right; margin-top:15px; margin-bottom:5px;"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                        <a class="btn btn-md btn-primary" onclick="loadData();" data-toggle="modal" data-target="#editAccountModal" style="float:right; margin-top:15px; margin-bottom:5px; margin-right:5px;"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                    <?php }?>
                    </div>
                    <div class="panel-body well" style="margin: 0px; padding-top:35px;">
                        <div class="row">
                            <div class="col-md-12" style="padding-right: 0px;">
                                <div class="form-group">
                                    <div class="row" style="margin-top: 15px;">

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil" ></i>&nbsp;Account id</span>
                                            <input type="text" id='aid' class="form-control" value="<?php echo $id; ?>" readonly>
                                        </div>

                                    </div>
                                    <div class="row" style="margin-top: 15px;">

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-barcode" ></i>&nbsp;AccountCode </span>
                                            <input type="text" class="form-control" value="<?php echo $acode; ?>" readonly>
                                        </div>

                                    </div>
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tasks" ></i>&nbsp;Account Type</span>
                                            <input type="text" class="form-control" value="<?php echo $atype; ?>" readonly>
                                        </div>

                                    </div>
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-money" ></i>&nbsp;Currency</span>
                                            <input type="text" class="form-control" value="<?php echo $acurrency; ?>" readonly>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>




                    </div>
                </div>
            </div>


            <div class="col-md-6" style="padding-right:5px; padding-left:30px;">
                <div class="panel panel-danger" style="margin-top:10px;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-money"></i><b>&nbsp;Account Balance:</b></h3> </div>
                    <div class="panel-body well" style="margin: 0px; padding-top:45px;">
                        <div class="row">
                            <div class="col-md-12" style="padding-right: 0px;">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12" style="padding-top:15px; padding-left:0px; padding-right:0px;">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-money" ></i>&nbsp;Opening Balance</span>
                                                <input type="text" class="form-control" value="<?php echo number_format($obalance); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12" style="padding-top:15px; padding-left:0px; padding-right:0px;">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-download" ></i>&nbsp;Total Recieved</span>
                                                <input type="text" class="form-control" value="<?php echo number_format($totalDebit); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12" style="padding-top:15px; padding-left:0px; padding-right:0px;">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-upload" ></i>&nbsp;Total Paid</span>
                                                <input type="text" class="form-control" value="<?php echo number_format($totalCredit); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" style="padding-top:16px; padding-left:0px; padding-right:0px;">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-money" ></i>&nbsp;Total Balance</span>
                                                <input type="text" class="form-control" value="<?php echo number_format($totalBalance); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>
            </div>

        </div>


        <div class="row" style="margin-top:10px;">
              <div class="col-md-6" style="padding:0px;">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i>&nbsp;From Date#</span>
                <input id="fdate" type="text" placeholder="click to select date" class="form-control" onchange="filter();">
                <span class="input-group-addon">  to</span>
                <input id="tdate"  placeholder="click to select date" type="text" class="form-control" onchange="filter();">
            </div>
                </div>
            
            
            <div class="col-md-6" style="padding-right:0px;">
                <a href="#" class="btn btn-md btn-primary" style="float:right; margin-left:10px;"  onclick="storeTable();">
                    <i class="fa fa-print"></i>&nbsp;Print</a><a href="#" class="btn btn-md btn-success" style="float:right;" data-toggle="modal" data-target="#newTransactionModal" onclick="clearModal();">
                    <i class="fa fa-plus"></i>&nbsp;New Transaction</a>
            </div>
        </div>




        <div class="panel panel-default" style="margin-top:10px;">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-tasks"></i><span class="break"></span>&nbsp; Account Transactions</h3>
            </div>
            <div class="panel-body" style="height:380px; overflow-y:auto; padding:0px;">
                <div class="row">
                    <table class="table table-bordered table-hover" id="ata" style="padding:0px;">
                        <thead>
                            <th class="text-center">
                                <i class="fa fa-pencil"></i>&nbsp;Transaction id#
                            </th>
                            <th class="text-center">
                                <i class="fa fa-calendar"></i>&nbsp;Transaction Date
                            </th>
                            <th class="text-center">
                                <i class="fa fa-file"></i>&nbsp;Discription
                            </th>
                            <th class="text-center">
                                <i class="fa fa-download"></i>&nbsp;Recieved
                            </th>
                            <th class="text-center">
                                <i class="fa fa-upload"></i>&nbsp;Paid
                            </th>
                            <th class="text-center">
                                <i class="fa fa-edit"></i>&nbsp;
                            </th>
                            <th class="text-center">
                                <i class="fa fa-trash"></i>&nbsp;
                            </th>
                        </thead>
                        <tbody id="Transactions">
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>


                </div>
            </div>
        </div>










        <div class="modal fade" id="newTransactionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-gears fa-2x"></i>&nbsp;New Transaction</h4>
                    </div>
                    <div class="modal-body well">
                        <form>
                            <div class="row">
                                <div class="form-group" style="padding-top: 20px;">
                                    <div class="col-md-7" style="padding-left:0px;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i>&nbsp;Date</span>
                                            <input id="trdate" type="text" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group" style="padding-top: 20px;">

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-file-text"></i>&nbsp;Discription</span>
                                        <textarea id="trdis" type="text" class="form-control" rows="3" cols="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group" style="padding-top: 20px;">
                                    <div class="col-md-6" style="padding-left:0px">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-download"></i>&nbsp;Received</span>
                                            <input id="trdebit" type="number" step="1" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="padding-right:0px">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-upload"></i>&nbsp;Paid</span>
                                            <input id="trcredit" type="number" step="1" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="saveTransaction();"><i class="fa fa-save"></i>&nbsp;Save changes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Close</button>

                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="editAccountModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bank fa-2x"></i>&nbsp;Edit Account</h4>
                    </div>
                    <div class="modal-body well">
                        <form id="AccountForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i>&nbsp;Account Id</span>
                                        <input name="acc_id" id="acc_id" type="text" class="form-control" value="<?php echo $id; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:15px;">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tag"></i>&nbsp;Account code</span>
                                        <input name="acc_code" id="acc_code" type="text" class="form-control" value="<?php echo $acode; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tasks"></i>&nbsp;Account Type</span>
                                        <select name="acc_type" id="acc_type" class="form-control" required>
                                            <?php 
                                    $result=query("select * from accounttypes");
                                    while($row=mysqli_fetch_array($result))
                                    {   
                                        if($row['typename']==$atype)
                                        echo '<option value='.$row[id].' selected>'.$row['typename'].'</option>';
                                        else
                                        echo '<option value='.$row[id].'>'.$row['typename'].'</option>';
                                    }
                                    
                                    ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:15px;">

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i>&nbsp;CurrencyCode</span>
                                        <select name="acc_currency" id="acc_currency" class="form-control" required>
                                            <?php 
                                    $result=query("select * from accountcurrency");
                                    while($row=mysqli_fetch_array($result))
                                    {   
                                        if($row['code']==$acurrency)
                                        echo '<option value='.$row[id].' selected>'.$row['code'].'</option>';
                                        else
                                        echo '<option value='.$row[id].'>'.$row['code'].'</option>';
                                    }
                                    
                                    ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-folder-open"></i>&nbsp;Account Opening Balance</span>
                                        <input name="opbalance" id="opbalance" type="number" class="form-control" value="<?php echo $obalance; ?>" required>
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

        
        <div class="modal fade" id="editrow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="padding: 5px;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-briefcase fa-1x" tabindex="-1"></i>&nbsp;Edit Transaction no:&nbsp;<span id="tid" style="color:red"></span>&nbsp;of&nbsp;Date:&nbsp;<span style="color:blue" id="sdate"></span></h4>
                    </div>
                    <form>
                        <div class="modal-body well">

                            <div class="row" style="margin:0px;padding:0px;">
                                <div class="panel panel-success" style="margin:0px;">
                                    <div class="panel-heading" style="padding:0px; padding-left:10px;">
                                        <h4 class="panel-title"><i class="fa fa-tasks"></i>&nbsp;Edit Entry</h4>
                                    </div>
                                    <div class="panel-body" style=" padding:0px;">
                                        <table class="table table-bordered table-hover ab" style="padding:0px; margin-bottom: 0px;">
                                            <thead>
                                            <th class="text-center">
                                                <i class="fa fa-file"></i>&nbsp;Discription
                                            </th>
                                            <th class="text-center">
                                                <i class="fa fa-download"></i>&nbsp;Recieved
                                            </th>
                                            <th class="text-center">
                                                <i class="fa fa-upload"></i>&nbsp;Paid
                                            </th>
                                            <th class="text-center">
                                                <i class="fa fa-edit"></i>&nbsp;
                                            </th>
                                            </thead>
                                            <tbody>
                                                <form>
                                                    <td>
                                                        <input class="form-control" type="text" placeholder="Discription" id="tdis" tabindex="1" />
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="number" placeholder="Paid" id="treceived" tabindex="2" />
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="number" placeholder="Recieved" id="tpaid" tabindex="3" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-md btn-warning" onclick="saveT();" tabindex="4"><i class="fa fa-edit"></i>&nbsp;Update Entry</button>
                                                    </td>
                                                </form>
                                            </tbody>

                                        </table>



                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="6"><i class="fa fa-remove"></i>&nbsp;Close</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
    </div>





    <script src="js/jquery.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/taffy-min.js"></script>
    <script src="js/jquery.json-2.4.min.js"></script>
    <script src="js/showAccount.js"></script>
    <script src="js/datepicker.js"></script>


    <script type="text/javascript">
        // When the document is ready
        $(document).ready(function() {

                
                $('#tdate').datepicker({
                    format: "dd-mm-yyyy"
                });    
                $('#fdate').datepicker({
                    format: "dd-mm-yyyy"
                });  
            
          
     

            var d = new Date();
            $('#trdate').val(d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear());
        });
    </script>