var db1;

function clearModal() {

    $('#pbalance').val("RS " + parseFloat($('#cbalance').val()).toLocaleString());
    $('#amountp').val('');
    $('#rbalance').val('');


    var url = 'views/gettingBillPayments.php?id=' + $('#billno').val();

    $.getJSON(url, function (data) {
        db1 = TAFFY(data);
        var rows = db1().get();
        $('#paymentsList').html("");
        if (data == "" || (rows[0]['id'] == null)) {

            $('#paymentsList').append("<tr class='danger'><td colspan='4'><center><b>No Payments Found !...</b></center></td></tr>");
            return;
        }
        for (var i = 0; i < 500; i++) {
            if ($('#userRole').val() == "Admin") {
                $('#paymentsList').append("<tr><td>" + rows[i]['id'] + "</td><td class='nocenter'>Rs " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td ><a class='btn btn-sm btn-danger' onclick='deleteArow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
            } else {
                $('#paymentsList').append("<tr><td>" + rows[i]['id'] + "</td><td class='nocenter'>Rs " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td ><a class='btn btn-sm btn-danger' style='display: none;' onclick='deleteArow(this);'><i class='fa" +
                    " fa-trash'></i>&nbsp;Delete</a></td></tr>");
            }
        }

    });

}

function calBalance() {

    if ($('#amountp').val() < 0) {
        $('#amountp').val('');
        return;
    }

    var pb = $('#cbalance').val();
    var rb = parseFloat(pb) - $('#amountp').val();
    $('#rbalance').val('Rs ' + parseFloat(rb).toLocaleString());


}
function filterPayments() {

    $('#paymentsList').html("");
    var adate = $('#pdate').val();
    var rows;


    if (!adate) {
        adate = "00/00/0000";
    }

    if (adate != "00/00/0000") {

        rows = db1().filter([{date: adate}]).get();

        if (rows.length == 0) {

            $('#paymentsList').append("<tr class='danger'><td colspan='4'><center><b>No result found..!</b></center></td></tr>")
        }
        else {
            for (var i = 0; i < rows.length; i++)
                if ($('#userRole').val() == "Admin") {
                    $('#paymentsList').append("<tr class='success'><td>" + rows[i]['id'] + "</td><td class='nocenter'>Rs " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td ><a class='btn btn-sm btn-danger' onclick='deleteArow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
                } else {
                    $('#paymentsList').append("<tr class='success'><td>" + rows[i]['id'] + "</td><td class='nocenter'>Rs " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td ><a class='btn btn-sm btn-danger' style='display: none;' onclick='deleteArow(this);'><i class='fa" +
                        " fa-trash'></i>&nbsp;Delete</a></td></tr>");
                }

        }


    }
    else {
        rows = db1().get();
        for (var i = 0; i < 500; i++)
            if ($('#userRole').val() == "Admin") {
                $('#paymentsList').append("<tr><td>" + rows[i]['id'] + "</td><td class='nocenter'>Rs " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td ><a class='btn btn-sm btn-danger' onclick='deleteArow(this);'><i class='fa fa-trash'></i>&nbsp;Delete</a></td></tr>");
            } else {
                $('#paymentsList').append("<tr><td>" + rows[i]['id'] + "</td><td class='nocenter'>Rs " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td class='nocenter'>" + rows[i]['date'] + "</td><td ><a class='btn btn-sm btn-danger' style='display: none;' onclick='deleteArow(this);'><i class='fa" +
                    " fa-trash'></i>&nbsp;Delete</a></td></tr>");
            }
    }
}


function deleteBill(id) {
    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this Bill !",
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
                    url: "views/deleteBill.php",
                    data: {
                        bid: id
                    },
                    success: function (msg) {

                    }
                });

                swal({
                    title: "Deleted!",
                    type: "success",
                    text: "Your Bill has been deleted.",
                    timer: 1200,
                    showConfirmButton: false
                });

                setTimeout('location.href="index.php?page=sell"', 2000);
            } else {
                swal({
                    title: "Cancelled",
                    type: "error",
                    text: "Your Bill is safe :)",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });

}

function payAmount() {
    if ($('#amountp').val() <= 0 || !$('#amountDate').val()) {
        swal("Input Error!", "Please fill the Amount Paid field.", "error");
        return;
    }
    var rb = parseFloat($('#cbalance').val()) - parseFloat($('#amountp').val());

    $.ajax({
        type: "POST",
        url: "views/payBillAmount.php",
        data: {
            bid: $('#billno').val(),
            balance: rb,
            paid: parseFloat($('#amountp').val()),
            date: $('#amountDate').val()

        },
        success: function (msg) {
            $('#PayModal').modal('hide');
            swal("Payment Added!", "Successfully", "success");
            setTimeout('location.href="index.php?page=showBill&billno=' + $('#billno').val() + '"', 1500);
        }
    });

}


$('#printBill').click(function () {

    setTimeout("location.href='views/printInvoice.php?billid=" + $('#billno').val() + "'", 500);


});


function deleteArow(id) {

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
                $.ajax({
                    url: 'views/deleteBillPayments.php',
                    type: "POST",
                    data: {rid: rowid},
                    success: function (msg) {

                        var d = id.parentNode.parentNode.rowIndex;
                        document.getElementById('bpay').deleteRow(d);
                        swal({
                            title: "Data Deleted!",
                            type: "success",
                            text: "Your action is done.",
                            timer: 1200,
                            showConfirmButton: false
                        });
                        setTimeout('location.href="index.php?page=showBill&billno=' + $('#billno').val() + '"', 1500);
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










