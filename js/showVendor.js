var db;
var db1;
var db2;
loadPurchaces();

function loadAdvance() {

    $('#advanceList').html(" ");

    var url = 'views/gettingVendorAdvance.php?id=' + $('#empid').val();

    $.getJSON(url, function (data) {
        db = TAFFY(data);
        var rows = db().get();
        if (data == "" || (rows[0]['id'] == null)) {

            $('#advanceList').append("<tr class='danger'><td colspan='5'><center><b>No Advance Found !...</b></center></td></tr>");
            return;
        }
        for (var i = 0; i < 500; i++) {
            if ($('#userRole').val() == "Admin") {
                $('#advanceList').append("<tr><td>" + rows[i]['id'] + "</td><td class='nocenter'>" + rows[i]['advancepaid'] + "</td><td class='nocenter'>" + rows[i]['advancededuct'] + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td ><a class='btn btn-sm btn-primary'  onclick='editArow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td></tr>");
            } else {
                $('#advanceList').append("<tr><td>" + rows[i]['id'] + "</td><td class='nocenter'>" + rows[i]['advancepaid'] + "</td><td class='nocenter'>" + rows[i]['advancededuct'] + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td ><a class='btn btn-sm btn-primary'  onclick='editArow(this);' disabled><i class='fa fa-edit'></i>&nbsp;Edit</a></td></tr>");
            }
        }

    });
}

function editArow(id) {


    $('#adid').html(id.parentNode.parentNode.children[0].innerHTML);
    $('#adad').val(id.parentNode.parentNode.children[1].innerHTML);
    $('#addad').val(id.parentNode.parentNode.children[2].innerHTML);
    $('#addate').html(id.parentNode.parentNode.children[3].innerHTML);

    $('#editAdrow').modal('show');
}

function editA() {
    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this  Data !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "No, cancel plz!",
            confirmButtonText: "Yes,Update it!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: 'views/updateVendorAdvance.php',
                    type: "POST",
                    data: {id: $('#adid').html(), ad: $('#adad').val(), dad: $('#addad').val()},
                    success: function (msg) {

                        swal({
                            title: "Data Updated!",
                            type: "success",
                            text: "Your action is done.",
                            timer: 1200,
                            showConfirmButton: false
                        });
                        setTimeout('location.href="index.php?page=showVendor&id=' + $('#empid').val() + '"', 1500);

                    }
                });
            } else {
                swal({
                    title: "Cancelled",
                    type: "error",
                    text: "Your data is safe :)",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });
}


function filterAdvance() {

    $('#advanceList').html("");
    var adate = $('#adate').val();
    var rows;


    if (!adate) {
        adate = "00/00/0000";
    }

    if (adate != "00/00/0000") {

        rows = db().filter([{date: adate}]).get();

        if (rows.length == 0) {

            $('#advanceList').append("<tr class='danger'><td colspan='5'><center><b>No result found..!</b></center></td></tr>")
        } else {
            for (var i = 0; i < rows.length; i++)
                $('#advanceList').append("<tr class='success'><td>" + rows[i]['id'] + "</td><td class='nocenter'>" + rows[i]['advancepaid'] + "</td><td class='nocenter'>" + rows[i]['advancededuct'] + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td ><a class='btn btn-sm btn-primary' onclick='editArow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td></tr>");

        }


    } else {
        rows = db().get();
        for (var i = 0; i < 500; i++)
            $('#advanceList').append("<tr><td>" + rows[i]['id'] + "</td><td class='nocenter'>" + rows[i]['advancepaid'] + "</td><td class='nocenter'>" + rows[i]['advancededuct'] + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td ><a class='btn btn-sm btn-primary' onclick='editArow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td></tr>");
    }
}


function calamount() {

    var u = 0;
    var r = 0;
    if ($('#newunit').val())
        u = $('#newunit').val();
    if ($('#newrate').val())
        r = $('#newrate').val();
    $('#newamount').val(parseFloat(u) * parseFloat(r));


}

//function saveItem()
//{
//    if(!$('#newunit').val()||!$('#newrate').val()||!$('#newdis').val())
//        {
//            swal("Input Error!","Please provide all fields data.","error");
//            return;
//        }    
//    $.ajax({
//         url:"views/addpurchase.php",
//         type:"POST",
//         data:{unit:$('#newunit').val(),rate:$('#newrate').val(),dis:$('#newdis').val(),id:$('#empid').val()},
//         success: function(msg){
//              swal({
//                                title:"Data Entered!",
//                                type: "success",
//                                text: "Your action is done.",
//                                timer: 1000,
//                                showConfirmButton: false
//                                });
//              // setTimeout('location.href="index.php?page=showVendor&id='+$('#empid').val()+'"',500);
//             loadPurchaces();
//         }
//    });
//$('#newunit').val("");
//$('#newrate').val("");
//$('#newdis').val("");
//$('#newamount').val("");
//$('#newdis').focus();
//}


function loadPayments() {

    $('#paymentsList').html(" ");
    var url = 'views/gettingVendorPayments.php?id=' + $('#empid').val();

    $.getJSON(url, function (data) {
        db1 = TAFFY(data);
        var rows = db1().get();
        if (data == "" || (rows[0]['id'] == null)) {

            $('#paymentsList').append("<tr class='danger'><td colspan='7'><center><b>No Payments Found !...</b></center></td></tr>");
            return;
        }
        for (var i = 0; i < 500; i++) {
            if ($('#userRole').val() == "Admin") {
                $('#paymentsList').append("<tr id='" + rows[i]['id'] + "'><td>" + (i + 1) + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td class='nocenter'>Rs " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['type'] + "</td><td class='nocenter'>" + rows[i]['detail'] + "</td><td class='nocenter'><a class='btn btn-sm btn-primary' onclick='editSrow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td class='nocenter'><a class='btn btn-sm btn-danger' onclick='deleteSrow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
            } else {
                $('#paymentsList').append("<tr id='" + rows[i]['id'] + "'><td>" + (i + 1) + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td class='nocenter'>Rs " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['type'] + "</td><td class='nocenter'>" + rows[i]['detail'] + "</td><td class='nocenter'><a class='btn btn-sm btn-primary' style='display: none;' onclick='editSrow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td class='nocenter'><a class='btn btn-sm btn-danger' style='display: none;' onclick='deleteSrow(this);'><i class='fa fa-trash' ></i>&nbsp;Delete</a></td></tr>");
            }
        }

    });
}

function toDate(dateStr) {
    var parts = dateStr.split("-");
    return new Date(parts[2], parts[1] - 1, parts[0]);
}

function filterPayments() {

    $('#paymentsList').html("");


    var fdate = $('#sfdate').val();
    var tdate = $('#stdate').val();

    var rows;

    if (!fdate) {
        fdate = "00/00/0000";
        tdate = "00/00/0000";
    } else if (!tdate) {
        tdate = "00/00/0000";
    }


    if (fdate != "00/00/0000" || tdate != "00/00/0000") {

        if (fdate != "00/00/0000" && tdate == "00/00/0000") {

            var flag = false;
            rows = db1().get();

            var c = 0;
            for (var i = 0; i < rows.length; i++) {
                if (toDate(fdate).getTime() === toDate(rows[i]['date']).getTime()) {
                    flag = true;
                    if ($('#userRole').val() == "Admin") {
                        $('#paymentsList').append("<tr id='" + rows[i]['id'] + "' class='success'><td>" + (i + 1) + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td class='nocenter'>Rs " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['type'] + "</td><td class='nocenter'>" + rows[i]['detail'] + "</td><td class='nocenter'><a class='btn btn-sm btn-primary' onclick='editSrow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td class='nocenter'><a class='btn btn-sm btn-danger' onclick='deleteSrow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
                    } else {
                        $('#paymentsList').append("<tr id='" + rows[i]['id'] + "'><td>" + (i + 1) + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td class='nocenter'>Rs " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['type'] + "</td><td class='nocenter'>" + rows[i]['detail'] + "</td><td class='nocenter'><a class='btn btn-sm btn-primary' style='display: none;' onclick='editSrow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td class='nocenter'><a class='btn btn-sm btn-danger' style='display: none;' onclick='deleteSrow(this);'><i class='fa fa-trash' ></i>&nbsp;Delete</a></td></tr>");
                    }
                }

            }

            if (!flag) {
                $('#paymentsList').append("<tr class='danger'><td colspan='7'><center><b>No Payments Found !...</b></center></td></tr>");
            }

            return;
        } else if (fdate != "00/00/0000" && tdate != "00/00/0000") {
            var flag = false;
            rows = db1().get();
            for (var i = 0; i < rows.length; i++) {
                if (toDate(rows[i]['date']).getTime() >= toDate(fdate).getTime() && toDate(rows[i]['date']).getTime() <= toDate(tdate).getTime()) {
                    flag = true;
                    if ($('#userRole').val() == "Admin") {
                        $('#paymentsList').append("<tr id='" + rows[i]['id'] + "' class='success'><td>" + (i + 1) + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td class='nocenter'>Rs " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['type'] + "</td><td class='nocenter'>" + rows[i]['detail'] + "</td><td class='nocenter'><a class='btn btn-sm btn-primary' onclick='editSrow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td class='nocenter'><a class='btn btn-sm btn-danger' onclick='deleteSrow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
                    } else {
                        $('#paymentsList').append("<tr id='" + rows[i]['id'] + "'><td>" + (i + 1) + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td class='nocenter'>Rs " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['type'] + "</td><td class='nocenter'>" + rows[i]['detail'] + "</td><td class='nocenter'><a class='btn btn-sm btn-primary' style='display: none;' onclick='editSrow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td class='nocenter'><a class='btn btn-sm btn-danger' style='display: none;' onclick='deleteSrow(this);'><i class='fa fa-trash' ></i>&nbsp;Delete</a></td></tr>");
                    }
                }

            }

            if (!flag) {
                $('#paymentsList').append("<tr class='danger'><td colspan='7'><center><b>No Payments Found !...</b></center></td></tr>");
            }

            return;
        }

    } else {
        rows = db1().get();
        for (var i = 0; i < 500; i++) {
            if ($('#userRole').val() == "Admin") {
                $('#paymentsList').append("<tr id='" + rows[i]['id'] + "'><td>" + (i + 1) + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td class='nocenter'>Rs " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['type'] + "</td><td class='nocenter'>" + rows[i]['detail'] + "</td><td class='nocenter'><a class='btn btn-sm btn-primary' onclick='editSrow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td class='nocenter'><a class='btn btn-sm btn-danger' onclick='deleteSrow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
            } else {
                $('#paymentsList').append("<tr id='" + rows[i]['id'] + "'><td>" + (i + 1) + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td class='nocenter'>Rs " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['type'] + "</td><td class='nocenter'>" + rows[i]['detail'] + "</td><td class='nocenter'><a class='btn btn-sm btn-primary' style='display: none;' onclick='editSrow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td class='nocenter'><a class='btn btn-sm btn-danger' style='display: none;' onclick='deleteSrow(this);'><i class='fa fa-trash' ></i>&nbsp;Delete</a></td></tr>");
            }
        }

    }


}


function calAmount() {

    if ($('#gamount').val().length == 0)
        gam = 0;
    else
        gam = $('#gamount').val();

    if ($('#gadvance').val().length == 0)
        gad = 0;
    else
        gad = $('#gadvance').val();

    if ($('#dadvance').val().length == 0)
        dad = 0;
    else
        dad = $('#dadvance').val();


    if (gam > 0 || dad > 0 || gad > 0)
        $('#btn_save').prop('disabled', false);
    else
        $('#btn_save').prop('disabled', true);


    $('#radvance').val(parseFloat($('#padvance').val()) - parseFloat(dad) + parseFloat(gad));

    if (gad)
        $('#fadvance').val(parseFloat(gad) - parseFloat(dad));

    $('#famount').val(parseFloat(parseFloat(gam)));

}


function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uimage").files[0]);

    oFReader.onload = function (oFREvent) {
        document.getElementById("preview").src = oFREvent.target.result;
    };
}

function payAmount() {
    var id = $('#empid').val();
    var dadvance = $('#dadvance').val();
    var fsalary = $('#famount').val();
    var gadvance = $('#fadvance').val();


    swal({
            title: "Are you sure?",
            text: "You will not be able to undo this step!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "No, cancel plz!",
            confirmButtonText: "Yes,sumbit it!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {

                swal({
                    title: "Updating",
                    type: "warning",
                    text: "Please Wait :)",
                    timer: 1300,
                    showConfirmButton: false
                });

                $.ajax({
                    type: "POST",
                    url: "views/payAmount.php",
                    data: {eid: id, da: dadvance, fs: fsalary, ga: gadvance},
                    success: function (msg) {

                    }
                });

                swal({
                    title: "Data updated!",
                    type: "success",
                    text: "Your action is done.",
                    timer: 1200,
                    showConfirmButton: false
                });

                setTimeout('location.href="index.php?page=showVendor&id=' + id + '"', 1500);


            } else {
                swal({
                    title: "Cancelled",
                    type: "error",
                    text: "Data updated not updated",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });


}


function saveEmployee() {


    if (!$("#vname").val()) {
        swal("Input Error!", "Please fill all required fields", "error");
        return;
    }


    $.ajax({
        url: "views/updateVendor.php",
        type: "POST",
        data: new FormData($('#employeeForm')[0]),
        contentType: false,
        cache: false,
        processData: false,
        success: function (msg) {
            //alert(msg);
            if (msg == "true") {
                $('#editEmployeeModal').modal('hide');
                swal({
                    title: "Updated!",
                    type: "success",
                    text: "Vendor is Updated successfully:)",
                    timer: 2000,
                    showConfirmButton: true
                });
                setTimeout("location.href='index.php?page=showVendor&id=" + $('#eid').html() + "'", 2000);
            }


        }
    });


}


function loadData() {
    $("#vname").val($("#etname").val());
    $("#vvendor_no").val($("#evendor_no").val());
    $("#vopening_balance").val($("#evopening_balance").val());
    $("#vemail").val($("#eemail").val());
    $("#vphone").val($("#ephone").val());
    $("#vcity").val($("#ecity").val());
    $('#vcity').selectpicker('val', $('#ecity').val());
    $("#vcountry").val($("#ecountry").val());
    $('#vcountry').selectpicker('val', $('#ecountry').val());
    $("#vzip_code").val($("#ezip_code").val());
    $("#vuid_no").val($("#euid_no").val());
    $("#vaccount_no").val($("#eaccount_no").val());
    $("#vgst").val($("#egst").val());
    $("#vaddress").val($("#eaddress").val());
    $("#vcompany").val($("#ecompany").val());
    document.getElementById("preview").src = document.getElementById("epreview").src;
}


function deleteEmployee(id) {
    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this Vendor and thier Data !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "No, cancel plz!",
            confirmButtonText: "Yes,delete it!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {

                swal({
                    title: "Deleting",
                    type: "warning",
                    text: "Please Wait :)",
                    timer: 1300,
                    showConfirmButton: false
                });
                $.ajax({
                    type: "POST",
                    url: "views/deleteVendor.php",
                    data: {eid: id},
                    success: function (msg) {
                        //alert(msg);
                    }
                });

                swal({
                    title: "Deleted!",
                    type: "success",
                    text: "Vendor deleted successfully.",
                    timer: 1200,
                    showConfirmButton: false
                });

                setTimeout('location.href="index.php?page=vendors"', 1500);

//                     }
//                }
//            });


            } else {
                swal({
                    title: "Cancelled",
                    type: "error",
                    text: "Your Vendor is safe :)",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });


}


function paySalary() {
    var id = $('#empid').val();
    var dadvance = $('#dadvance').val();
    var fsalary = $('#fsalary').val();

    var gadvance = $('#gadvance').val();


    swal({
            title: "Are you sure?",
            text: "You will not be able to undo this step!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "No, cancel plz!",
            confirmButtonText: "Yes,sumbit it!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {

                swal({
                    title: "Updating",
                    type: "warning",
                    text: "Please Wait :)",
                    timer: 1300,
                    showConfirmButton: false
                });

                $.ajax({
                    type: "POST",
                    url: "views/paySalary.php",
                    data: {eid: id, da: dadvance, fs: fsalary, ga: gadvance},
                    success: function (msg) {
//                                    alert(msg);
                    }
                });

                swal({
                    title: "Data updated!",
                    type: "success",
                    text: "Your action is done.",
                    timer: 1200,
                    showConfirmButton: false
                });

                setTimeout('location.href="index.php?page=showVendor&id=' + id + '"', 1500);


            } else {
                swal({
                    title: "Cancelled",
                    type: "error",
                    text: "Data updated not updated",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });


}


function loadPurchaces() {

    $('#vendorpurchase').html(" ");

    var url = 'views/gettingVendorPurchases.php?id=' + $('#empid').val();

    $.getJSON(url, function (data) {
        db2 = TAFFY(data);
        var rows = db2().get();
        if (data == "" || (rows[0]['id'] == null)) {
            $('#vendorpurchase').append("<tr class='danger'><td colspan='8'><center><b>No Data Found !...</b></center></td></tr>");
            return;
        }
        for (var i = 0; i < 500; i++) {
            if ($('#userRole').val() == "Admin") {
                $('#vendorpurchase').append("<tr><td>" + rows[i]['id'] + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['product'] + "</td><td>" + rows[i]['unit'] + "</td><td>" + rows[i]['rate'] + "</td><td>Rs " + (parseFloat(rows[i]['rate']) * parseFloat(rows[i]['unit'])).toLocaleString() + "</td><td><a class='btn btn-sm btn-primary' onclick='editrow(this);' ><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td ><a class='btn btn-sm btn-danger' onclick='deleterow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
            } else {
                $('#vendorpurchase').append("<tr><td>" + rows[i]['id'] + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['product'] + "</td><td>" + rows[i]['unit'] + "</td><td>" + rows[i]['rate'] + "</td><td>Rs " + (parseFloat(rows[i]['rate']) * parseFloat(rows[i]['unit'])).toLocaleString() + "</td><td><a class='btn btn-sm btn-primary' onclick='editrow(this);' style='display: none;'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td ><a class='btn btn-sm btn-danger' style='display: none;' onclick='deleterow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
            }
        }

    });

}

function deleterow(id) {

    var rowid = id.parentNode.parentNode.children[0].innerHTML;


    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this  Data !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "No, cancel plz!",
            confirmButtonText: "Yes,delete it!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {


                swal({
                    title: "Deleting",
                    type: "warning",
                    text: "Please Wait :)",
                    timer: 3000,
                    showConfirmButton: false
                });

                $.ajax({
                    url: 'views/deletepurchase.php',
                    type: "POST",
                    data: {rid: rowid},
                    success: function (msg) {

                        var d = id.parentNode.parentNode.rowIndex;
                        document.getElementById('vendorp').deleteRow(d);
                        swal({
                            title: "Data Deleted!",
                            type: "success",
                            text: "Your action is done.",
                            timer: 1200,
                            showConfirmButton: false
                        });
                        setTimeout('location.href="index.php?page=showVendor&id=' + $('#empid').val() + '"', 1500);

                    }
                });


            } else {
                swal({
                    title: "Cancelled",
                    type: "error",
                    text: "Your data is safe :)",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });


}


function editrow(id) {


    $('#pid').html(id.parentNode.parentNode.children[0].innerHTML);
    $('#epdate').html(id.parentNode.parentNode.children[1].innerHTML);
    $('#epname').val(id.parentNode.parentNode.children[2].innerHTML);
    $('#punit').val(id.parentNode.parentNode.children[3].innerHTML);
    $('#prate').val(id.parentNode.parentNode.children[4].innerHTML);

    $('#editrow').modal('show');


}

function saveE() {


    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this  Data !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "No, cancel plz!",
            confirmButtonText: "Yes,Update it!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {


                swal({
                    title: "Updating",
                    type: "warning",
                    text: "Please Wait :)",
                    timer: 3000,
                    showConfirmButton: false
                });

                $.ajax({
                    url: 'views/Updatepurchase.php',
                    type: "POST",
                    data: {
                        pid: $('#pid').html(),
                        pname: $('#epname').val(),
                        punit: $('#punit').val(),
                        prate: $('#prate').val()
                    },
                    success: function (msg) {

                        swal({
                            title: "Data Updated!",
                            type: "success",
                            text: "Your action is done.",
                            timer: 1200,
                            showConfirmButton: false
                        });
                        setTimeout('location.href="index.php?page=showVendor&id=' + $('#empid').val() + '"', 1500);

                    }
                });


            } else {
                swal({
                    title: "Cancelled",
                    type: "error",
                    text: "Your data is safe :)",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });


}


function deleteSrow(id) {


    swal({
            title: "Are you sure?",
            text: "You will can not  able to undo this step!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "No, cancel plz!",
            confirmButtonText: "Yes,sumbit it!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {

                swal({
                    title: "Updating",
                    type: "warning",
                    text: "Please Wait :)",
                    timer: 1300,
                    showConfirmButton: false
                });

                $.ajax({
                    type: "POST",
                    url: "views/deleteVendorPayment.php",
                    data: {id: id.parentNode.parentNode.id},
                    success: function (msg) {
                        // alert(msg);
                    }
                });

                swal({
                    title: "Amount Deleted!",
                    type: "success",
                    text: "Your action is done.",
                    timer: 1200,
                    showConfirmButton: false
                });

                setTimeout(function () {
                    loadPayments();
                }, 1500);


            } else {
                swal({
                    title: "Cancelled",
                    type: "error",
                    text: "Data updated not updated",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });


}


function editSrow(id) {

    $('#payid').html(id.parentNode.parentNode.id);
    $('#paydate').html(id.parentNode.parentNode.children[1].innerHTML);
    $('#ppaid').val(id.parentNode.parentNode.children[2].innerHTML.replace(/[^0-9\.\-]+/g, ""));
    $('#pptype').val(id.parentNode.parentNode.children[3].innerHTML);
    $('#ppdetail').val(id.parentNode.parentNode.children[4].innerHTML);

    $('#editprow').modal('show');


}

function editpay() {
    if (!$('#ppaid').val()) {
        swal("Input Error!", "Please fill all required fields", "error");
        return;
    }

    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this  Data !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "No, cancel plz!",
            confirmButtonText: "Yes,Update it!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: 'views/updateVendorPayment.php',
                    type: "POST",
                    data: {
                        id: $('#payid').html(),
                        amount: $('#ppaid').val(),
                        type: $('#pptype').val(),
                        detail: $('#ppdetail').val()
                    },
                    success: function (msg) {
                        // alert(msg);
                        swal({
                            title: "Data Updated!",
                            type: "success",
                            text: "Your action is done.",
                            timer: 1200,
                            showConfirmButton: false
                        });
                        $('#editprow').modal('hide');
                        setTimeout(function () {
                            loadPayments();
                        }, 1500);
                    }
                });


            } else {
                swal({
                    title: "Cancelled",
                    type: "error",
                    text: "Your data is safe :)",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });
}


function paymentPay() {


    if (!$('#pamount').val() || !$('#paymentDate').val()) {
        swal("Input Error!", "Please fill all required fields", "error");
        return;
    }


    swal({
            title: "Are you sure?",
            text: "You will can  able to undo this step!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "No, cancel plz!",
            confirmButtonText: "Yes,sumbit it!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {

                swal({
                    title: "Updating",
                    type: "warning",
                    text: "Please Wait :)",
                    timer: 1300,
                    showConfirmButton: false
                });

                $.ajax({
                    type: "POST",
                    url: "views/payVendorAmount.php",
                    data: {
                        vid: $('#empid').val(),
                        amount: $('#pamount').val(),
                        date: $('#paymentDate').val(),
                        detail: $('#pdetail').val(),
                        type: $('#ptype').val()
                    },
                    success: function (msg) {
                        // alert(msg);
                    }
                });
                swal({
                    title: "Payment  Added!",
                    type: "success",
                    text: "Your action is done.",
                    timer: 1200,
                    showConfirmButton: false
                });

                setTimeout(function () {
                    loadPayments();
                }, 1500);


            } else {
                swal({
                    title: "Cancelled",
                    type: "error",
                    text: "Payment not Added",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });


}

function toDate(dateStr) {
    var parts = dateStr.split("-");
    return new Date(parts[2], parts[1] - 1, parts[0]);
}


function filterPurchase() {
    $('#vendorpurchase').html("");

    var fdate = $('#fdate').val();
    var tdate = $('#tdate').val();

    var rows;

    if (!fdate) {
        fdate = "00/00/0000";
        tdate = "00/00/0000";
    } else if (!tdate) {
        tdate = "00/00/0000";
    }


    if (fdate != "00/00/0000" || tdate != "00/00/0000") {

        if (fdate != "00/00/0000" && tdate == "00/00/0000") {

            var flag = false;
            rows = db2().get();

            var c = 0;
            for (var i = 0; i < rows.length; i++) {
                if (toDate(fdate).getTime() === toDate(rows[i]['date']).getTime()) {
                    flag = true;
                    if ($('#userRole').val() == "Admin") {
                        $('#vendorpurchase').append("<tr class='success'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['product'] + "</td><td>" + rows[i]['unit'] + "</td><td>" + rows[i]['rate'] + "</td><td>Rs " + (parseFloat(rows[i]['rate']) * parseFloat(rows[i]['unit'])).toLocaleString() + "</td><td><a class='btn btn-sm btn-primary' onclick='editrow(this);' ><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td ><a class='btn btn-sm btn-danger' onclick='deleterow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
                    } else {
                        $('#vendorpurchase').append("<tr><td>" + rows[i]['id'] + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['product'] + "</td><td>" + rows[i]['unit'] + "</td><td>" + rows[i]['rate'] + "</td><td>Rs " + (parseFloat(rows[i]['rate']) * parseFloat(rows[i]['unit'])).toLocaleString() + "</td><td><a class='btn btn-sm btn-primary' onclick='editrow(this);' style='display: none;'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td ><a class='btn btn-sm btn-danger' style='display: none;' onclick='deleterow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
                    }
                }

            }

            if (!flag) {
                $('#vendorpurchase').append("<tr class='danger'><td colspan='9'><center><b>No result found..!</b></center></td></tr>");
            }

            return;
        } else if (fdate != "00/00/0000" && tdate != "00/00/0000") {
            var flag = false;
            rows = db2().get();
            for (var i = 0; i < rows.length; i++) {
                if (toDate(rows[i]['date']).getTime() >= toDate(fdate).getTime() && toDate(rows[i]['date']).getTime() <= toDate(tdate).getTime()) {
                    flag = true;
                    if ($('#userRole').val() == "Admin") {
                        $('#vendorpurchase').append("<tr class='success'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['product'] + "</td><td>" + rows[i]['unit'] + "</td><td>" + rows[i]['rate'] + "</td><td>Rs " + (parseFloat(rows[i]['rate']) * parseFloat(rows[i]['unit'])).toLocaleString() + "</td><td><a class='btn btn-sm btn-primary' onclick='editrow(this);' ><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td ><a class='btn btn-sm btn-danger' onclick='deleterow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
                    } else {
                        $('#vendorpurchase').append("<tr><td>" + rows[i]['id'] + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['product'] + "</td><td>" + rows[i]['unit'] + "</td><td>" + rows[i]['rate'] + "</td><td>Rs " + (parseFloat(rows[i]['rate']) * parseFloat(rows[i]['unit'])).toLocaleString() + "</td><td><a class='btn btn-sm btn-primary' onclick='editrow(this);' style='display: none;'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td ><a class='btn btn-sm btn-danger' style='display: none;' onclick='deleterow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
                    }
                }

            }

            if (!flag) {
                $('#vendorpurchase').append("<tr class='danger'><td colspan='9'><center><b>No result found..!</b></center></td></tr>");
            }

            return;
        }

    } else {
        rows = db2().get();
        for (var i = 0; i < 500; i++) {
            if ($('#userRole').val() == "Admin") {
                $('#vendorpurchase').append("<tr><td>" + rows[i]['id'] + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['product'] + "</td><td>" + rows[i]['unit'] + "</td><td>" + rows[i]['rate'] + "</td><td>Rs " + (parseFloat(rows[i]['rate']) * parseFloat(rows[i]['unit'])).toLocaleString() + "</td><td><a class='btn btn-sm btn-primary' onclick='editrow(this);' ><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td ><a class='btn btn-sm btn-danger' onclick='deleterow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
            } else {
                $('#vendorpurchase').append("<tr><td>" + rows[i]['id'] + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['product'] + "</td><td>" + rows[i]['unit'] + "</td><td>" + rows[i]['rate'] + "</td><td>Rs " + (parseFloat(rows[i]['rate']) * parseFloat(rows[i]['unit'])).toLocaleString() + "</td><td><a class='btn btn-sm btn-primary' onclick='editrow(this);' style='display: none;'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td ><a class='btn btn-sm btn-danger' style='display: none;' onclick='deleterow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
            }
        }

    }
}










