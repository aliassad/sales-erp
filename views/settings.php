<?php
if($_SESSION['role']!="Admin") {
    echo '<script>setTimeout(function(){window.location="index.php?page=home";},100);</script>';
}
else {
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
            margin: 0px;
            margin-bottom: 3px;
        }

    </style>


    <div class="page-content">
        <!-- Page Heading -->
 
           <div class="row" style="margin-left:10px;" >
            <div class="btn-group btn-breadcrumb">
            <a href="index.php?page=home" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
            <a href="#"  class="btn btn-primary" ><i class="fa fa-gears"></i>&nbsp;Settings</a>  
            </div>
        </div>

        <!-- /.row -->
        <div class="row" style="padding:10px;">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-gears"></i><span class="break"></span>&nbsp;Settings panel</h3>
                </div>
                <div class="panel-body well" style="height:405px; margin:0px;">
                    <div class="row">
                        <div class="input-group">
                        <a  href="views/mysql_backup.php?action=1" class="btn btn-lg btn-info" onclick="back_up();" ><b><i class="fa
                        fa-download"></i>&nbsp;Download Backup</a>
                        </div>
                    </div>
<!--                    <div class="row" style="padding-top:10px; ">-->
<!--                        <div class="input-group">-->
<!--                        <a  class="btn btn-lg btn-danger" onclick="reset();" ><b><i class="fa-->
<!--                        fa-gears"></i>&nbsp;-->
<!--                                Reset Database</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="row" style="padding-top:10px; ">-->
<!--                        <div class="col-md-1">-->
<!--                            <label><i class="fa fa-file"></i>&nbsp;Upload File:</label>-->
<!--                        </div>-->
<!--                        <form id="uploadDatabaseForm">-->
<!--                        <div class="col-md-2">-->
<!--                            <input type="file" name="sqlFile" id="sqlFile">-->
<!--                        </div>-->
<!--                        <div class="col-md-4">-->
<!--                            <a onclick="reset_upload();" name="btn-upload"   class="btn btn-md btn-warning"><i class="fa-->
<!--                            fa-upload"></i>&nbsp;Reset Database and Upload Backup</a>-->
<!--                        </div>-->
<!--                        </form>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /.contain
    er-fluid -->

    </div>

        <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
<script src="js/taffy-min.js"></script>
<script src="js/jquery.json-2.4.min.js"></script>
<script src="js/sweetalert.min.js"></script>


<script>
    function reset() {
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this  Database Data !",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "No, cancel plz!",
                confirmButtonText: "Yes,Reset it!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    swal({
                        title:"Resetting Database... !",
                        type: "warning",
                        text: "Please wait!",
                        timer: 1200,
                        showConfirmButton: false
                    });
                    $(".loader").fadeIn("fast");
                    $("#side_menu").fadeOut("fast");

                            $.ajax({
                                url:"views/mysql_backup.php",
                                type: "POST",
                                data:{action:2},
                                cache: false,
                                success:function (msg) {
                                    $(".loader").fadeOut("fast");
                                    $("#side_menu").fadeIn("fast");
                                    if (msg == 'true') {

                                        swal({
                                            title:"Database Empty Now!",
                                            type: "success",
                                            text: "Your action is done.",
                                            timer: 1200,
                                            showConfirmButton: true
                                        })

                                        setTimeout(function () {
                                            window.location="index.php?page=settings";
                                        },2000);
                                    }
                                    else
                                    {
                                        swal("Eroor !","Retry Again","error");
                                        return;

                                    }

                        }
                    });

                } else {
                    swal({
                        title:"Cancelled",
                        type: "error",
                        text: "Your database is safe :)",
                        timer: 1200,
                        showConfirmButton: false
                    });
                }
            });


    }
    function reset_upload() {
        if(!$('#sqlFile').val())
        {
            swal({
                title:"Back file not selected!",
                type: "error",
                text: "Please Select backup a File !",
                timer: 1200,
                showConfirmButton: false
            });
        return;
        }
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover current data without backup!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "No, cancel plz!",
                confirmButtonText: "Yes,Upload it!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    swal({
                        title:"Uploading Database... !",
                        type: "warning",
                        text: "Please wait!",
                        timer: 1500,
                        showConfirmButton: false
                    });
                    $(".loader").fadeIn("fast");
                    $("#side_menu").fadeOut("fast");

                    $.ajax({
                        url:"views/mysql_backup.php",
                        type: "POST",
                        data: new FormData($('#uploadDatabaseForm')[0]),
                        contentType:false,
                        cache: false,
                        processData:false,
                        success:function (msg) {
                            if (msg == 'true') {

                                swal({
                                    title:"Database Uploaded!",
                                    type: "success",
                                    text: "Your action is done.",
                                    timer: 1500,
                                    showConfirmButton: true
                                });
                                setTimeout(function () {
                                window.href='index.php?page=settings';},2000);
                            }
                            else
                            {
                                swal("Eroor !","Retry Again","error");
                                return;

                            }
                            $(".loader").fadeOut("fast");
                            $("#side_menu").fadeIn("fast");
                        }
                        });

                } else {
                    swal({
                        title:"Cancelled",
                        type: "error",
                        text: "Your database is safe :)",
                        timer: 1200,
                        showConfirmButton: false
                    });
                }
            });

    }
    function back_up() {

        window.location="views/mysql_backup.php?action=1";
    }
</script>

<?php } ?>