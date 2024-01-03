<?php
setlocale(LC_MONETARY,"en_US");
$cid=$_GET["idno"];
$result=query("select * from member where id='$cid'");
while($row=mysqli_fetch_array($result))
{
    $address=$row['address'];
    $name=$row['name'];
    $phone=$row['phone'];
    $email=$row['cardno'];
}

$result=query("SELECT sum(m.amount) tamount,count(*) tb  from mentry m WHERE  m.mno='$email'");
if($result){
    while($row=mysqli_fetch_array($result))
    {
        $tbills=$row['tb'];
        $tamount=$row['tamount'];
    }

}
else
{
    $tbills=0;
    $tamount=0;
}

?>
<div class="page-content">

    <!-- Page Heading -->
    <div class="row" style="padding-left: 15px;">
        <div class="btn-group btn-breadcrumb">
            <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
            <a href="index.php?page=members" class="btn btn-default"><i class="fa fa-credit-card"></i>&nbsp;Members</a>
            <a href="#" class="btn btn-primary"><i class="fa fa-user"></i>&nbsp;Member Details</a>
        </div>
    </div>


</div>



<div class="row" style="padding-left:15px; padding-right:15px;">
    <div class="col-lg-5" style="padding-left:0px; ">
        <div class="panel panel-info" style="margin-top:10px;">

            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i><b>&nbsp;Member Detail:</b></h3>
                <span id="cid" style="display: none;"><?php echo $cid; ?></span>
                <?php
                if($_SESSION['role']=="Admin"){?>
                <a onclick="deleteCustomer(<?php echo $cid; ?>)" class="btn btn-sm btn-danger" style="float:right; margin-top:20px; margin-bottom:5px;"><i class="fa fa-trash"></i>&nbsp;Delete</a><a class="btn btn-sm btn-primary" onclick="loadData();" data-toggle="modal" data-target="#CustomerModal" style="float:right; margin-top:20px; margin-bottom:5px; margin-right:5px;"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                <?php } ?>
            </div>

            <div class="panel-body">
                <table class="table table-bordered" style="padding:0px;">
                    <tbody id="tocustomer">
                    <tr>
                        <td class="nocenter">
                            <i class="fa fa-user"></i>&nbsp;<b>Name: </b> <span id="name"><?php echo $name; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-credit-card"></i>&nbsp;<b>Member Ship No:</b> <span id="email"><?php echo $email; ?></span></td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-book"></i>&nbsp;<b>Address:</b><span id="address"><?php echo $address; ?></span></td>
                    </tr>
                    <tr>
                        <td class="nocenter"><i class="fa fa-phone"></i>&nbsp;<b>Phone:</b> <span id="phone"><?php echo $phone; ?></span></td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="col-lg-5 col-lg-offset-2" style="padding-left:0px; ">
        <div class="panel panel-info" style="margin-top:10px;">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money"></i><b>&nbsp;Payment &amp; Bills  Detail:</b></h3>
                <span id="cid" style="display: none;"><?php echo $cid; ?></span>
            </div>
            <div class="panel-body">
                <table class="table table-bordered" style="padding:0px;margin-top:35px;">
                    <tbody id="tocustomer">
                    <tr >
                        <td class="nocenter" style="font-size:24px;">
                            <i class="fa fa-file-text"></i>&nbsp;<b>Total Bills: </b>
                            <?php echo number_format($tbills); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size:24px;" class="nocenter"><i class="fa fa-money"></i>&nbsp;<b>Total Sale  Amount:</b>
                            <?php echo "RS ".number_format($tamount,2); ?>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<div class="row" style="padding-left:15px; padding-right:15px;">
    <div class="col-md-9" style="padding-left:5px;">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i>&nbsp;From Date#</span>
            <input id="fdate" type="text" placeholder="click to select date" class="form-control" onchange="filter();">
            <span class="input-group-addon">  to</span>
            <input id="tdate"  placeholder="click to select date" type="text" class="form-control" onchange="filter();">
        </div>
    </div>
</div>
<div class="row" style="padding-left:15px; padding-right:15px;">
    <div class="panel panel-info" style="margin-top:10px;">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-file-text"></i><b>&nbsp;Member Bills Detail</b></h3>
        </div>
        <div class="panel-body" style="height:385px; overflow-y:auto; padding:0px">
            <div class="row">
                <table class="table table-bordered table-hover" style="padding:0px;">
                    <thead>
                    <th class="text-center">
                        <i class="fa fa-file"></i>&nbsp;Sr no#
                    </th>
                    <th class="text-center">
                        <i class="fa fa-file-text-o"></i>&nbsp;Bill no#
                    </th>
                    <th class="text-center">
                        <i class="fa fa-money"></i>&nbsp;Total Amount
                    </th>
                    <th class="text-center">
                        <i class="fa fa-calendar"></i>&nbsp;Date
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user fa-2x"></i> Edit Customer Details</h4>
            </div>
            <div class="modal-body well">
                <form>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i>&nbsp;Name</span>
                                    <input type="text" id="cname" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group" style="padding-top: 20px;">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-credit-card"></i>&nbsp;Member Ship No#</span>
                                    <input id="cemail" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i>&nbsp;Phone</span>
                                    <input id="cphone" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group" style="padding-top: 20px;">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-book"></i>&nbsp;Address</span>
                                    <textarea id="caddress" type="text" class="form-control" rows="3" cols="5"></textarea>
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


<script src="js/jquery.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/taffy-min.js"></script>
<script src="js/jquery.json-2.4.min.js"></script>
<script src="js/showMember.js"></script>
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

    });
</script>
