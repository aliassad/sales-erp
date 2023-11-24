var db;
const CURRENCY_SIGN = $('#CURRENCY_SIGN').val()
$(document).ready(function () {
    var url = "views/gettingBills.php?id=" + $('#cid').html();
    $.getJSON(url, function (data) {
        db = TAFFY(data);
        var rows = db().get();
        if (data == "") {
            $('#bills').append("<tr class='danger'><td colspan='8'><center><b>No Bills Found !...</b></center></td></tr>");
            return;
        }

        for (var i = 0; i < 500; i++)
            $('#bills').append("<tr onclick='showbill(this);'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['name'] + "</td><td>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['paid']).toLocaleString() + "</td><td>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['balance']).toLocaleString() + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['ddate'] + "</td><td><span class=' label label-primary' >" + rows[i]['type'] + "</span></td></tr>");

    });

});

function toDate(dateStr) {
    var parts = dateStr.split("-");
    return new Date(parts[2], parts[1] - 1, parts[0]);
}

function filter() {

    $('#bills').html("");
    var sid = $('#billno').val();
    var fdate = $('#fdate').val();
    var tdate = $('#tdate').val();

    var rows;

    if (!fdate) {
        fdate = "00/00/0000";
        tdate = "00/00/0000";
    } else if (!tdate) {
        tdate = "00/00/0000";
    }


    if (sid || fdate != "00/00/0000" || tdate != "00/00/0000") {

        if (sid || fdate != "00/00/0000" && tdate == "00/00/0000") {

            var flag = false;
            rows = db().get();

            var c = 0;
            for (var i = 0; i < rows.length; i++) {
                if (sid == rows[i]['id'] || toDate(fdate).getTime() === toDate(rows[i]['date']).getTime()) {
                    flag = true;
                    $('#bills').append("<tr onclick='showbill(this);' class='success'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['name'] + "</td><td>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['paid']).toLocaleString() + "</td><td>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['balance']).toLocaleString() + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['ddate'] + "</td><td><span class=' label label-primary' >" + rows[i]['type'] + "</span></td></tr>");
                }

            }

            if (!flag) {
                $('#bills').append("<tr class='danger'><td colspan='8'><center><b>No result found..!</b></center></td></tr>");
            }

            return;
        } else if (fdate != "00/00/0000" && tdate != "00/00/0000") {
            var flag = false;
            rows = db().get();
            for (var i = 0; i < rows.length; i++) {
                if (toDate(rows[i]['date']).getTime() >= toDate(fdate).getTime() && toDate(rows[i]['date']).getTime() <= toDate(tdate).getTime()) {
                    flag = true;
                    $('#bills').append("<tr onclick='showbill(this);' class='success'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['name'] + "</td><td>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['paid']).toLocaleString() + "</td><td>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['balance']).toLocaleString() + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['ddate'] + "</td><td><span class=' label label-primary' >" + rows[i]['type'] + "</span></td></tr>");
                }

            }

            if (!flag) {
                $('#bills').append("<tr class='danger'><td colspan='8'><center><b>No result found..!</b></center></td></tr>");
            }

            return;
        }

    } else {
        rows = db().get();
        for (var i = 0; i < 500; i++) {
            $('#bills').append("<tr onclick='showbill(this);'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['name'] + "</td><td>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['paid']).toLocaleString() + "</td><td>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['balance']).toLocaleString() + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['ddate'] + "</td><td><span class=' label label-primary' >" + rows[i]['type'] + "</span></td></tr>");
        }

    }


}

function showbill(row) {
    var id = row.cells[0].innerHTML;
    window.location.href = "index.php?page=showBill&billno=" + id + "&cid=" + $('#cid').html();
}

function deleteCustomer(id) {
    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this Customer and thier Bills !",
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

                $.ajax({
                    type: "POST",
                    url: "views/checkBalance.php",
                    data: {cid: id},
                    success: function (msg) {
                        if (parseFloat(msg) > 0.0) {
                            swal("Customer Balance is Not Zero!", "Please clear the balance then delete it!", "error");
                            setTimeout('location.href="index.php?page=showCustomer&idno=' + id + '"', 2000);
                            return;
                        } else {
                            $.ajax({
                                type: "POST",
                                url: "views/deleteCustomer.php",
                                data: {cid: id},
                                success: function (msg) {

                                }
                            });

                            swal({
                                title: "Deleted!",
                                type: "success",
                                text: "Your Customer has been deleted.",
                                timer: 1200,
                                showConfirmButton: false
                            });

                            setTimeout('location.href="index.php?page=customers"', 2000);

                        }
                    }
                });


            } else {
                swal({
                    title: "Cancelled",
                    type: "error",
                    text: "Your Customer is safe :)",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });


}


function loadData() {
    $('#cname').val('');
    $('#cemail').val('');
    $('#cphone').val('');
    $('#caddress').val('');
    $('#ctelephone').val('');
    $('#ccustomer_no').val('');
    $('#cuid_no').val('');
    $('#caccount_no').val('');
    $('#czip_code').val('');
    $('#cgst').val('');

    $('#cname').val($('#name').html());
    $('#cemail').val($('#email').html());
    $('#ctelephone').val($('#telephone').html());
    $('#cphone').val($('#phone').html());
    $('#ccity').val($('#city').html());
    $('#ccity').selectpicker('val', $('#city').html());
    $('#ccountry').val($('#country').html());
    $('#ccountry').selectpicker('val', $('#country').html());
    $('#ccompany').val($('#company').html());
    $('#caddress').val($('#address').html());
    $('#copening_balance').val($('#opening_balance').html());
    $('#ccustomer_no').val($('#customer_no').html());
    $('#cuid_no').val($('#uid_no').html());
    $('#caccount_no').val($('#account_no').html());
    $('#czip_code').val($('#zip_code').html());
    $('#cgst').val($('#gst').html());


}

function updateCustomer() {
    var id = $('#cid').html();
    $.ajax({
        type: "POST",
        url: "views/updateCustomer.php",
        data: {
            cid: id,
            cname: $('#cname').val(),
            cemail: $('#cemail').val(),
            cphone: $('#cphone').val(),
            caddress: $('#caddress').val(),
            ccompany: $('#ccompany').val(),
            ccity: $('#ccity').val(),
            opening_balance: $('#copening_balance').val(),
            telephone: $('#ctelephone').val(),
            country: $('#ccountry').val(),
            customer_no: $('#ccustomer_no').val(),
            account_no: $('#caccount_no').val(),
            uid_no: $('#cuid_no').val(),
            gst: $('#cgst').val(),
            zip_code: $('#czip_code').val()
        },
        success: function (msg) {
            if (msg == 'true') {
                $('#CustomerModal').modal('hide');
                swal("Customer Detail is updated!!", "Successfully :)", "success");
            }
            setTimeout('location.href="index.php?page=showCustomer&idno=' + id + '"', 2000);
        }
    });

}


var db1;

function loadPayments() {

    $('#paymentsList').html(" ");
    var url = 'views/gettingCustomerPayments.php?id=' + $('#cid').html();

    $.getJSON(url, function (data) {
        db1 = TAFFY(data);
        var rows = db1().get();
        if (data == "" || (rows[0]['id'] == null)) {

            $('#paymentsList').append("<tr class='danger'><td colspan='7'><center><b>No Payments Found !...</b></center></td></tr>");
            return;
        }
        for (var i = 0; i < 500; i++) {
            if ($('#userRole').val() == "Admin") {
                $('#paymentsList').append("<tr id='" + rows[i]['id'] + "'><td>" + (i + 1) + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td class='nocenter'>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['type'] + "</td><td class='nocenter'>" + rows[i]['detail'] + "</td><td class='nocenter'><a class='btn btn-sm btn-primary' onclick='editSrow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td class='nocenter'><a class='btn btn-sm btn-danger' onclick='deleteSrow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
            } else {
                $('#paymentsList').append("<tr id='" + rows[i]['id'] + "'><td>" + (i + 1) + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td class='nocenter'>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['type'] + "</td><td class='nocenter'>" + rows[i]['detail'] + "</td><td class='nocenter'><a class='btn btn-sm btn-primary' style='display: none;' onclick='editSrow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td class='nocenter'><a class='btn btn-sm btn-danger' style='display: none;' onclick='deleteSrow(this);'><i class='fa fa-trash' ></i>&nbsp;Delete</a></td></tr>");
            }
        }

    });
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
                        $('#paymentsList').append("<tr id='" + rows[i]['id'] + "' class='success'><td>" + (i + 1) + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td class='nocenter'>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['type'] + "</td><td class='nocenter'>" + rows[i]['detail'] + "</td><td class='nocenter'><a class='btn btn-sm btn-primary' onclick='editSrow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td class='nocenter'><a class='btn btn-sm btn-danger' onclick='deleteSrow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
                    } else {
                        $('#paymentsList').append("<tr id='" + rows[i]['id'] + "'><td>" + (i + 1) + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td class='nocenter'>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['type'] + "</td><td class='nocenter'>" + rows[i]['detail'] + "</td><td class='nocenter'><a class='btn btn-sm btn-primary' style='display: none;' onclick='editSrow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td class='nocenter'><a class='btn btn-sm btn-danger' style='display: none;' onclick='deleteSrow(this);'><i class='fa fa-trash' ></i>&nbsp;Delete</a></td></tr>");
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
                        $('#paymentsList').append("<tr id='" + rows[i]['id'] + "' class='success'><td>" + (i + 1) + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td class='nocenter'>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['type'] + "</td><td class='nocenter'>" + rows[i]['detail'] + "</td><td class='nocenter'><a class='btn btn-sm btn-primary' onclick='editSrow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td class='nocenter'><a class='btn btn-sm btn-danger' onclick='deleteSrow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
                    } else {
                        $('#paymentsList').append("<tr id='" + rows[i]['id'] + "'><td>" + (i + 1) + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td class='nocenter'>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['type'] + "</td><td class='nocenter'>" + rows[i]['detail'] + "</td><td class='nocenter'><a class='btn btn-sm btn-primary' style='display: none;' onclick='editSrow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td class='nocenter'><a class='btn btn-sm btn-danger' style='display: none;' onclick='deleteSrow(this);'><i class='fa fa-trash' ></i>&nbsp;Delete</a></td></tr>");
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
                $('#paymentsList').append("<tr id='" + rows[i]['id'] + "'><td>" + (i + 1) + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td class='nocenter'>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['type'] + "</td><td class='nocenter'>" + rows[i]['detail'] + "</td><td class='nocenter'><a class='btn btn-sm btn-primary' onclick='editSrow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td class='nocenter'><a class='btn btn-sm btn-danger' onclick='deleteSrow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
            } else {
                $('#paymentsList').append("<tr id='" + rows[i]['id'] + "'><td>" + (i + 1) + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td class='nocenter'>" + CURRENCY_SIGN + " " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['type'] + "</td><td class='nocenter'>" + rows[i]['detail'] + "</td><td class='nocenter'><a class='btn btn-sm btn-primary' style='display: none;' onclick='editSrow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td class='nocenter'><a class='btn btn-sm btn-danger' style='display: none;' onclick='deleteSrow(this);'><i class='fa fa-trash' ></i>&nbsp;Delete</a></td></tr>");
            }
        }

    }


}


function deleteSrow(id) {


    swal({
            title: "Are you sure?",
            text: "You will can not  able to undo this step!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "No, cancel plz!",
            confirmButtonText: "Yes,submit it!",
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
                    url: "views/deleteCustomerPayment.php",
                    data: {id: id.parentNode.parentNode.id},
                    success: function (msg) {
                        var d = id.parentNode.parentNode.id;
                        document.getElementById('ssad').deleteRow(d);
                    }
                });

                swal({
                    title: "Amount Deleted!",
                    type: "success",
                    text: "Your action is done.",
                    timer: 1200,
                    showConfirmButton: false
                });


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
            text: "You will be able to recover this  Data !",
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
                    url: 'views/updateCustomerPayment.php',
                    type: "POST",
                    data: {
                        id: $('#payid').html(),
                        amount: $('#ppaid').val(),
                        type: $('#pptype').val(),
                        detail: $('#ppdetail').val()
                    },
                    success: function (msg) {
                        swal({
                            title: "Data Updated!",
                            type: "success",
                            text: "Your action is done.",
                            timer: 1200,
                            showConfirmButton: false
                        });
                        $('#editprow').modal('hide');
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


function customerPayment() {

    if (!$('#pamount').val()) {
        swal("Input Error!", "Please enter amount.", "error");
        return;
    }

    swal({
            title: "Are you sure?",
            text: "You will be able to recover this  Data !",
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
                    url: 'views/addCustomerPayment.php',
                    type: "POST",
                    data: {
                        id: $('#cid').html(),
                        date: $('#paymentDate').val(),
                        amount: $('#pamount').val(),
                        type: $('#ptype').val(),
                        detail: $('#pdetail').val()
                    },
                    success: function (msg) {
                        swal({
                            title: "Data Updated!",
                            type: "success",
                            text: "Your action is done.",
                            timer: 1200,
                            showConfirmButton: false
                        });
                        loadPayments();
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