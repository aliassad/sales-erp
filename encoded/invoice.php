<?php if(isset($_GET['page']))
    $page=$_GET['page'];
else 
{$page="home"; }

$products=query("select * from product");


?>
<style>
    #discount > td > input 
    {
        font-size:32px; 
        
    }
    #discount > td > input[id="total"] 
    {
        font-size:48px; 
        height: 49px;
    }
    
</style>

    <div class="container-fluid">
        <div class="page-content">
            <!-- Page Heading -->


               <div class="row">
                <div class="col-md-4" style="padding-left:0px;">
                <div class="btn-group btn-breadcrumb">
                    <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                    <a href="index.php?page=sell" class="btn btn-default"><i class="fa fa-shopping-cart"></i>&nbsp;Selling</a>
                    <a href="#" class="btn btn-primary"><i class="fa fa-file-text"></i>&nbsp;New Bill</a>
                </div>
                </div>
                <div class="col-md-4">
                <center><div class="form-group"><button class="btn btn-md btn-info" style="margin-top:5px;" ><b>Bill No</b> <span
                                class="badge"><?php
                        $result = query("SHOW TABLE STATUS LIKE 'bill'");
                        $data = mysqli_fetch_assoc($result);
                        $next_increment = $data['Auto_increment'];
                    echo ($next_increment);
                    ?></span>
                       <input id='billidno' value="<?php echo ($next_increment); ?>" style="display:none;" ></button> </div></center>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-md btn-info" style="margin-top:5px; float: right" ><input id="billdate"  type="text" class="form-control" style="width:166px;font-size:24px;  "/></button>
                </div>
            </div>


            <!-- /.row -->


            <div class="row" style="padding-top:0px;">
                <div class="col-md-4" style="padding-left: 0px; ">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i>&nbsp;Customer</span>
                            <select id="cuname" class="selectpicker show-tick"  name="cunane" data-live-search="true"  title='Select Customer...'>
                                <?php
                                    $result=query("select concat(id,': ',name) as name from customer");
                                    while($row=mysqli_fetch_array($result))
                                    {
                                            echo '<option>'.$row['name'].'</option>';
                                    }
                                    ?>
                            </select>

                        </div>
                    </div>
                </div>
                  <div class="col-md-2" style="padding: 0;">
                      <a href="#" class="btn btn-md btn-success"  data-toggle="modal" data-target="#newCustomerModal" onclick="clearModal();">
                          <i class="fa fa-plus"></i>&nbsp;New Customer</a>
                      </div>
                <div class="col-md-3">
                    <div class="form-group" >
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-edit"></i>&nbsp;Type</span>
                            <select style="font-size:18px" id="intitle" class="form-control">
                                <option>Invoice</option>
                                <option>Quotation</option>
<!--                                <option>Order</option>-->
                            </select>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row" style="padding-bottom:5px;">
                <div class="col-md-4" style="padding-left:0px">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-male"></i>&nbsp;WalkIn Customer Name:</span>
                        <input type="text" class="form-control" id="wname" name="wname" disabled>
                    </div>
                </div>
                <div class="col-md-4" style="padding-left:0px">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-mobile"></i>&nbsp;Cell No:</span>
                        <input type="text" class="form-control" name="cno" id="cno"  disabled>
                    </div>
                </div>
                <div class="col-md-4" style="padding-left:0px">
                    <div class="input-group" >
                        <span class="input-group-addon"  style="background-color:#2D89EF; color: #FFFFFF;" ><i class="fa fa-credit-card"></i>&nbsp;Member Ship No:</span>
                        <select  class="selectpicker show-tick"  id="mcno" name="mcno" data-live-search="true"  title='Select Member...'>
                            <option value="0" style="background-color: red;">None</option>
                            <?php
                            $result=query("select cardno  from member");
                            while($row=mysqli_fetch_array($result))
                            {
                                echo '<option>'.$row['cardno'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary" style="
    margin-bottom: 10px;">

                <!--
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-fw fa-edit"></i> Invoice</h3>
                            </div>
-->
                <div class="panel-body" style="; overflow-y:none; padding:0px;">

                    <table class="table  table-bordered table-hover"> 
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
                    <b>%</b>&nbsp;Discount
                </th>
                <th class="text-center">
                    <i class="fa fa-money "></i>&nbsp;Amount
                </th>
                <th class="text-center">
                    #</th>

                        </thead>
                        <tbody id="invoice">
                            <tr>
                                <td class="itemno">1</td>
                                <td style="width:30%;">
                                    <select id="product1" onchange="loadProductDetail(1);" class="form-control">
                                    </select>
                                </td>
                                <td style=" width:12%">
                                    <input type="number" id="rate1" placeholder="@" class="form-control" onkeyup="calAmount(this);">
                                </td>
                                <td style=" width:12%">
                                    <input type="number" id="unit1" placeholder="Qty" class="form-control" onkeyup="calAmount(this);">
                                </td>
                                <td style=" width:12%">
                                    <input type="number" id="disc1" placeholder="Discount" tabindex='-1' class="form-control" onkeyup="calAmount(this);">
                                </td>
                                <td style=" width:20%">
                                    <input type="text" tabindex="-1" id="amount1" placeholder="0" class="form-control amt" readonly value="0">
                                </td>
                                <td>
                                    <button id="1" tabindex="-1" class="btn btn-danger glyphicon glyphicon-remove row-remove" onclick="delete_emp(1);"> </button>
                                </td>
                            </tr>


                        </tbody>
                        <tfoot>
                            <th style="width:8%;">
                                <input type="text" id="add_row" class="form-control" placeholder="New Item">
                            </th>
                        </tfoot>


                    </table>

                </div>
                <div class="panel-footer clearfix" style="padding-top: 0px; padding-bottom: 0px; margin: 0px;">
                    <table class="table" style="margin: 0px;">
                        <thead>
                            <th>Gross Total(PKR):</th>
                            <th>Discount:</th>
                            <th>Amount Recieved:</th>
                            <th>Net Total(PKR):</th>
                        </thead>
                        <tbody>
                            <tr id="discount">
                                <td>
                                    <input type="text" id="ftotal" class="form-control" value="0" readonly tabindex="-1">
                                </td>
                                <td>
                                    <input type="number" id="discount1" class="form-control" onkeyup="dis();" placeholder="0.0" />
                                </td>
                                <td>
                                    <input type="number" id="paid" class="form-control" onkeyup="dis();" placeholder="0.0" />
                                </td>
                                <td>
                                    <input type="text" id="total"  class="form-control" value="0" readonly tabindex="-1">
                                </td>                
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12" style="padding:0px;">
                    <table class="table table-bordered">
                        <thead>
                            <th style="background:lightgrey;"><i class="fa fa-newspaper-o"></i>&nbsp;Notes</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <textarea id="notes" class="form-control" rows="3" style="font-size:14px;"></textarea>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <th>
                                <center>
                                    <a href="#" class="btn btn-lg btn-primary" style="align:center;" id="showModal" onclick="updateInvoice();"> Check out</a>
                                </center>
                            </th>
                        </tfoot>
                    </table>
                </div>


            </div>





        </div>

    </div>
    <!-- /.container-fluid -->


    </div>
    <!-- /#page-wrapper -->





    <div class="modal fade" id="newCustomerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user fa-2x"></i>&nbsp;New Customer</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-user"></i>&nbsp;Name</span>
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
                                        <span class="input-group-addon"><i class="fa fa-globe"></i>&nbsp;Email</span>
                                        <input id="cemail" type="email" class="form-control">
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
                    <button type="button" class="btn btn-primary" onclick="saveCustomer();"><i class="fa fa-save"></i>&nbsp;Save changes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Close</button>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body" id="myDivToPrint" style="overflow-y:auto;max-height:570px;">
                    <center>
                        <div class="row" style="width:90%;">
                            <center><h3 id="type" style="border:4px double black"></h3></center>
                            <div class="col-lg-6" style="padding-left: 0px;">
                                <div class="col-lg-10" style="padding-left: 0px;">
                                    <table class="table">
                                        <tbody id="tocustomer">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-6" style="padding-right: 0px;">
                                <div class="col-lg-10 col-lg-offset-2" style="padding-right: 0px;">
                                    <table class="table">
                                       
                                            
                                        
                                        <tbody>
                                            <tr>
                                                <td class="nocenter">
                                                   
                                                         <i class="fa fa-tag"></i>&nbsp;<b>Trx ID: </b>
                                                    <span class="badge"id="invNo"></span>
                                                        
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="nocenter" ><i class="fa fa-calendar"></i>&nbsp;<b>Date:&nbsp;</b><span id="fbilldate"></span></td>
                                            <tr>
                                                <td class="nocenter"><i class="fa fa-calendar"></i>&nbsp;<b>Due Date: </b>
                                                    <input type="text" placeholder="click to select date" class="form-control" id="duedate" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </center>

                    <center>
                        <table class="table  table" style="width:90%;">
                            <thead style="background-color:lightgrey;">
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
                                <b>%</b>&nbsp;Discount
                            </th>
                            <th class="text-center">
                                <i class="fa fa-money "></i>&nbsp;Amount
                            </th>
                            </thead>
                            <tbody id="inv">
                                <script>
                                    function updateInvoice() {

                                        if($('#cuname').val().replace(/[^0-9\.\-]+/g,"")==1&&($('#paid').val()==0||!$('#paid').val())){
                                            swal("Please add valid Amount","for walk in customer full amount must be entered!!","error");
                                            return;
                                        } else if($('#cuname').val().replace(/[^0-9\.\-]+/g,"")==1&&$('#total').val()!=0){
                                            swal("Please add valid Amount","Net total must be zero","error");
                                            return;
                                        }

                                        if(!$('#cuname').val())
                                        {
                                            swal("Error! No Customer selected","Please select Customer first","error");
                                            return;
                                        }
                                        $('#myModal').modal('toggle');


                                        $.ajax({
                                            type: "POST",
                                            url: "views/customerdata.php",
                                            data: {
                                                name: $('#cuname').val()
                                            },
                                            success: function(data) {
                                                $('#tocustomer').html(data);
                                            }
                                        });

                                                $('#invNo').html($('#billidno').val());
                                    


                                        $('#inv').html("");
                                        $('#type').html("");
                                        $('#gtotal').html("");
                                        $('#fbilldate').html($('#billdate').val());
                                        $('#type').append($('#intitle').val());

                                        $('#gtotal').append('<tr><td colspan="4" rowspan="3" style="border-style:none;"><table class="table table-bordered"><thead><th style="background:lightgrey;" ><i class="fa fa-newspaper-o"></i> Notes</th></thead><tbody><tr><td><textarea id="mnot" class="form-control" rows="3" style="font-size:14px;" readonly></textarea></td></tr></tbody></table></td><td></td><td colspan="2"><table class="table table-bordered"><tbody><tr><td class="nocenter" ><b>Grand Total:</b></td><td class="nocenter" > RS ' + parseFloat(Math.round($('#ftotal').val())).toLocaleString() + '</td></tr><tr><td class="nocenter" ><b>Amount Paid:</b></td><td class="nocenter" > RS ' + parseFloat(Math.round($('#paid').val())).toLocaleString() + '</td></tr><tr><td class="nocenter" ><b>Discount:</b></td><td class="nocenter"> RS ' + parseFloat(Math.round($('#discount1').val())).toLocaleString() + '</td></tr><tr><td class="nocenter" style="background:lightgrey;"><b>Balance:</b></td><td class="nocenter" > RS ' + parseFloat(Math.round($('#total').val())).toLocaleString() + '</td></tr></tbody></table></td></tr>');
                                        $('#invoice tr').each(function(row, tr) {

                                            $('#inv').append('<tr><td>' + $(tr).find('td:eq(0)').text() + '</td><td>' + $(tr).find('td:eq(1)').children().val() + '</td><td>' + $(tr).find('td:eq(2)').children().val() + '</td><td>' + $(tr).find('td:eq(3)').children().val() + '</td><td>' + $(tr).find('td:eq(4)').children().val() + '</td><td>' + $(tr).find('td:eq(5)').children().val() + '</td></tr>');

                                        });
                                        $('#mnot').val($('#notes').val());
                                    }
                                </script>

                            </tbody>
                            <tfoot id="gtotal"></tfoot>
                        </table>
                    </center>
                    <!--    <center><p style="background:lightgrey; padding:5px;">Thank you for your business!</p></center>-->
                    <!--    <p style="padding:20px;"><span style="float:left;"><b>Prepared by:_______________ </b></span><span style="float:right;"><b>Aprroved by:_______________</b></span>       </p>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveInvoice();" data-dismiss="modal"><i class="fa fa-save"></i>&nbsp;Save</button>
                    <button type="button" class="btn btn-primary" onclick="saveprintInvoice();"><i class="fa fa-save"></i>&nbsp;Save&amp;&nbsp;<i class="fa fa-print"></i>&nbsp;Print</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>&nbsp;Close</button>

                </div>
            </div>
        </div>
    </div>




    <script src="js/sweetalert.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.json-2.4.min.js"></script>
    <script src="js/taffy-min.js"></script>
    <script src="js/datepicker.js"></script>


 <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#duedate').datepicker({
                    format: "dd-mm-yyyy"
                });
                $('#billdate').datepicker({
                    format: "dd-mm-yyyy"
                });

                $('#billdate').datepicker('setValue','gotoCurrent');
            });
        </script>
    <script src="js/Invoice.js"></script>
