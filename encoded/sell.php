<div class="container-fluid">
    <div class="page-content">
        <!-- Page Heading -->


        <div class="row">
           <div class="col-md-6" style="padding-left:0px;">
            <div class="btn-group btn-breadcrumb">
                <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                <a href="index.php?page=customers" class="btn btn-default"><i class="fa fa-group"></i>&nbsp;Customers</a>
                <a href="#" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>&nbsp;Selling</a>
            </div>
        </div>

        <div class="col-md-6" style="padding-top: 10px; padding-right: 0;">
            <a href="index.php?page=invoice" class="btn btn-md btn-success" style="float:right; margin-left:15px; font-size:15px;">
                <i class="fa fa-plus"></i>&nbsp;New Bill </a>
<!--            <a href="index.php?page=production" class="btn btn-md btn-info" style="float:right; margin-left:15px; font-size:15px;">-->
<!--                <i class="fa fa-files-o"></i>&nbsp;Order Sheet </a>-->
        </div>
        </div>
        <div class="row" style="margin-top:10px;">
            <div class="col-md-3" style="padding:0px;">

                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Bill no#</span>
                    <input id="billno" type="number" class="form-control" onkeyup="filter();">
                </div>
            </div>
            <div class="col-md-4" style="padding-left:5px; padding-right:3px;">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i>&nbsp;Customer#</span>
                    <select id="customer" class="selectpicker show-tick" data-live-search="true" title="Enter Customer Name.." onchange="filter();">
                        <option class="btn-success">Show all</option>
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

            <div class="col-md-5" style="padding:0px;">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i>&nbsp;From Date#</span>
                    <input id="fdate" type="text" placeholder="click to select date" class="form-control" onchange="filter();">
                    <span class="input-group-addon">  to</span>
                    <input id="tdate" type="text" placeholder="click to select date" class="form-control" onchange="filter();">
                </div>
            </div>





        </div>
        <!-- /.row -->




        <div class="panel panel-default" style="margin-top:20px;">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-copy"></i><span class="break"></span>&nbsp;Bills</h3>
            </div>
            <div class="panel-body" style="height:395px; overflow-y:auto; padding:0px;">
                <div class="row">
                    <table class="table table-bordered table-hover" style="padding:0px;">
                        <thead>
                        <tr>
                            <th class="text-center">
                                <i class="fa fa-file"></i>&nbsp;Bill&nbsp;no#
                            </th>
                            <th class="text-center">
                                <i class="fa fa-user"></i>&nbsp;Customer
                            </th>
                            <th class="text-center">
                                <i class="fa fa-money"></i>&nbsp;Total&nbsp;Amount
                            </th>
                            <th class="text-center">
                                <i class="fa fa-money"></i>&nbsp;Amount&nbsp;Recieved
                            </th>
                            <th class="text-center">
                                <i class="fa fa-money"></i>&nbsp;Balance
                            </th>
                            <th class="text-center">
                                <i class="fa fa-calendar"></i>&nbsp;Date
                            </th>
                            <th class="text-center">
                                <i class="fa fa-calendar"></i>&nbsp;Due&nbsp;by
                            </th>
                            <th class="text-center">
                                <i class="fa fa-file-text"></i>&nbsp;Bill&nbsp;Type
                            </th>
                        </tr>
                        </thead>
                        <tbody id="bills">
                                <tr id="loading" ><td colspan="8"><center > <img src="img/loading.gif"> </center></td></tr>
                        </tbody>
                    </table>


                </div>
            </div>
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
<script src="js/sell.js"></script>
<script src="js/bootstrap-select.js"></script>
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