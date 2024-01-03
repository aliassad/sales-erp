var db;
$(document).ready(function () {

    var url = 'views/gettingTransactions.php?id=' + $('#aid').val();

    $.getJSON(url, function (data) {

        db = TAFFY(data);
        var rows = db().get();
        if (data == "" || (rows[0]['id'] == null)) {
            $('#Transactions').append("<tr class='danger'><td colspan='7'><center><b>No Transactions Found !...</b></center></td></tr>");
            return;
        }
        for (var i = 0; i < 500; i++) {
            if ($('#userRole').val() == "Admin") {
                $('#Transactions').append("<tr><td>" + rows[i]['id'] + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['dis'] + "</td><td>" + parseFloat(rows[i]['debit']) + $('#CURRENCY_SIGN').val() + "</td><td>" + parseFloat(rows[i]['credit'])+$('#CURRENCY_SIGN').val() + "</td><td ><a class='btn btn-sm btn-primary' onclick='editArow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td><a class='btn btn-sm btn-danger glyphicon glyphicon-remove row-remove'  onclick='deletetr(this);'></a></td></tr>");
            } else {

                $('#Transactions').append("<tr><td>" + rows[i]['id'] + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['dis'] + "</td><td>" + parseFloat(rows[i]['debit']) + $('#CURRENCY_SIGN').val() + "</td><td>" + parseFloat(rows[i]['credit'])+$('#CURRENCY_SIGN').val() + "</td><td ><a class='btn btn-sm btn-primary' style='display: none';  onclick='editArow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td><a class='btn btn-sm btn-danger glyphicon glyphicon-remove row-remove'" +
                    " style='display: none';  onclick='deletetr(this);'></a></td></tr>");
            }
        }

    });

});


function toDate(dateStr) {
    var parts = dateStr.split("-");
    return new Date(parts[2], parts[1] - 1, parts[0]);
}

function filter() {

    $('#Transactions').html("");
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
            rows = db().get();
            for (var i = 0; i < rows.length; i++) {
                if (toDate(fdate).getTime() === toDate(rows[i]['date']).getTime()) {
                    flag = true;
                    if ($('#userRole').val() == "Admin") {
                        $('#Transactions').append("<tr class='success'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['dis'] + "</td><td>" + parseFloat(rows[i]['debit'])+$('#CURRENCY_SIGN').val()+"</td><td>" + parseFloat(rows[i]['credit'])+$('#CURRENCY_SIGN').val()+"</td><td ><a class='btn btn-sm btn-primary' onclick='editArow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td><a class='btn btn-sm btn-danger glyphicon glyphicon-remove row-remove'  onclick='deletetr(this);'></a></td></tr>");
                    } else {

                        $('#Transactions').append("<tr class='success'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['dis'] + "</td><td>" + parseFloat(rows[i]['debit'])+$('#CURRENCY_SIGN').val()+"</td><td>" + parseFloat(rows[i]['credit'])+$('#CURRENCY_SIGN').val()+"</td><td ><a class='btn btn-sm btn-primary' style='display: none';  onclick='editArow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td><a class='btn btn-sm btn-danger glyphicon glyphicon-remove row-remove'" +
                            " style='display: none';  onclick='deletetr(this);'></a></td></tr>");
                    }
                }

            }

            if (!flag) {
                $('#Transactions').append("<tr class='danger'><td colspan='7'><center><b>No result found..!</b></center></td></tr>");
            }

            return;
        } else if (fdate != "00/00/0000" && tdate != "00/00/0000") {
            var flag = false;
            rows = db().get();

            var c = 0;
            for (var i = 0; i < rows.length; i++) {
                if (toDate(rows[i]['date']).getTime() >= toDate(fdate).getTime() && toDate(rows[i]['date']).getTime() <= toDate(tdate).getTime()) {
                    flag = true;
                    if ($('#userRole').val() == "Admin") {
                        $('#Transactions').append("<tr class='success'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['dis'] + "</td><td>" + parseFloat(rows[i]['debit'])+$('#CURRENCY_SIGN').val()+"</td><td>" + parseFloat(rows[i]['credit'])+$('#CURRENCY_SIGN').val()+"</td><td ><a class='btn btn-sm btn-primary' onclick='editArow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td><a class='btn btn-sm btn-danger glyphicon glyphicon-remove row-remove'  onclick='deletetr(this);'></a></td></tr>");
                    } else {

                        $('#Transactions').append("<tr class='success'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['dis'] + "</td><td>" + parseFloat(rows[i]['debit'])+$('#CURRENCY_SIGN').val()+"</td><td>" + parseFloat(rows[i]['credit'])+$('#CURRENCY_SIGN').val()+"</td><td ><a class='btn btn-sm btn-primary' style='display: none';  onclick='editArow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td><a class='btn btn-sm btn-danger glyphicon glyphicon-remove row-remove'" +
                            " style='display: none';  onclick='deletetr(this);'></a></td></tr>");
                    }
                }

            }

            if (!flag) {
                $('#Transactions').append("<tr class='danger'><td colspan='7'><center><b>No result found..!</b></center></td></tr>");
            }

            return;
        }

    } else {
        rows = db().get();

        var c = 0;
        for (var i = 0; i < 500; i++) {
            if ($('#userRole').val() == "Admin") {
                $('#Transactions').append("<tr><td>" + rows[i]['id'] + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['dis'] + "</td><td>" + parseFloat(rows[i]['debit'])+$('#CURRENCY_SIGN').val()+"</td><td>" + parseFloat(rows[i]['credit'])+$('#CURRENCY_SIGN').val()+"</td><td ><a class='btn btn-sm btn-primary' onclick='editArow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td><a class='btn btn-sm btn-danger glyphicon glyphicon-remove row-remove'  onclick='deletetr(this);'></a></td></tr>");
            } else {

                $('#Transactions').append("<tr><td>" + rows[i]['id'] + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['dis'] + "</td><td>" + parseFloat(rows[i]['debit'])+$('#CURRENCY_SIGN').val()+"</td><td>" + parseFloat(rows[i]['credit'])+$('#CURRENCY_SIGN').val()+"</td><td ><a class='btn btn-sm btn-primary' style='display: none';  onclick='editArow(this);'><i class='fa fa-edit'></i>&nbsp;Edit</a></td><td><a class='btn btn-sm btn-danger glyphicon glyphicon-remove row-remove'" +
                    " style='display: none';  onclick='deletetr(this);'></a></td></tr>");
            }
        }

    }


}


function saveAccount() {


    if (!$("#acc_id").val() || !$('#acc_code').val() || !$('#acc_type').val() || !$('#acc_currency').val() || !$('#opbalance').val()) {
        swal("Input Error!", "Please fill all required fields", "error");
        return;
    }


    $.ajax({
        url: "views/updateAccount.php",
        type: "POST",
        data: new FormData($('#AccountForm')[0]),
        contentType: false,
        cache: false,
        processData: false,
        success: function (msg) {
            if (msg == 'true') {
                $('#editAccountModal').modal('hide');
                swal({
                    title: "Saved!",
                    type: "success",
                    text: "New Account Details is updated successfully:)",
                    timer: 2000,
                    showConfirmButton: true
                });
                setTimeout("location.href='index.php?page=showAccount&Accountno=" + $('#aid').val() + "'", 2000);
            }
        }

    });


}

function deleteAccount(id) {
    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this Account and thier Transactions !",
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
                    text: "Deleting the account .....",
                    timer: 1200,
                    showConfirmButton: false
                });
                $.ajax({
                    type: "POST",
                    url: "views/deleteAccount.php",
                    data: {cid: id},
                    success: function (msg) {

                    }
                });

                swal({
                    title: "Deleted!",
                    type: "success",
                    text: "Your Account has been deleted.",
                    timer: 1200,
                    showConfirmButton: false
                });

                setTimeout('location.href="index.php?page=accounts"', 2000);


            } else {
                swal({
                    title: "Cancelled",
                    type: "error",
                    text: "Your Account is safe :)",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });


}


function clearModal() {

    $('#trdis').val('');
    $('#trdebit').val('');
    $('#trcredit').val('');


}

function saveTransaction() {
    if (!$('#trdis').val() || (!$('#trdebit').val() && !$('#trcredit').val())) {
        swal("Input Error!", "Please fill all required fields", "error");
        return;
    }
    swal("Commiting Transaction!", "Adding the account transaction...", "warning");

    $.ajax({
        type: "POST",
        url: "views/addTransaction.php",
        data: {
            aid: $("#aid").val(),
            tdate: $("#trdate").val(),
            dis: $('#trdis').val(),
            debit: $('#trdebit').val(),
            credit: $('#trcredit').val()
        },
        success: function (msg) {

        }
    });

    swal({
        title: "Transaction Committed!",
        type: "success",
        text: "Your Account Transaction is Added Successfully.",
        timer: 2000,
        showConfirmButton: true
    });

    setTimeout("location.href='index.php?page=showAccount&Accountno=" + $('#aid').val() + "'", 2000);


}

function deletetr(id) {
    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this  Transactions !",
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
                    text: "Deleting the account .....",
                    timer: 1200,
                    showConfirmButton: false
                });
                var rid = id.parentNode.parentNode.children[0].innerHTML;
                $.ajax({
                    url: 'views/deleteTransaction.php',
                    type: "POST",
                    data: {id: rid},
                    success: function (msg) {
                        var d = id.parentNode.parentNode.rowIndex;
                        document.getElementById('ata').deleteRow(d);

                    }
                });

                swal({
                    title: "Transaction Deleted",
                    type: "success",
                    text: "Transaction deleted successfully!",
                    timer: 1200,
                    showConfirmButton: false
                });

            } else {
                swal({
                    title: "Cancelled",
                    type: "error",
                    text: "Your Transaction is safe :)",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });


}


function editArow(id) {


    $('#tid').html(id.parentNode.parentNode.children[0].innerHTML);

    $('#sdate').html(id.parentNode.parentNode.children[1].innerHTML);
    $('#tdis').val(id.parentNode.parentNode.children[2].innerHTML);

    var number = Number((id.parentNode.parentNode.children[3].innerHTML).replace(/[^0-9\.]+/g, ""));
    var number1 = Number((id.parentNode.parentNode.children[4].innerHTML).replace(/[^0-9\.]+/g, ""));
    $('#treceived').val(number);
    $('#tpaid').val(number1);
//
    $('#editrow').modal('show');
}

function saveT() {
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
                    url: 'views/updateTransaction.php',
                    type: "POST",
                    data: {
                        id: $('#tid').html(),
                        dis: $('#tdis').val(),
                        recieved: $('#treceived').val(),
                        paid: $('#tpaid').val()
                    },
                    success: function (msg) {

                        swal({
                            title: "Data Updated!",
                            type: "success",
                            text: "Your action is done.",
                            timer: 1200,
                            showConfirmButton: false
                        });
                        setTimeout("location.href='index.php?page=showAccount&Accountno=" + $('#aid').val() + "'", 1500);
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


function storeTable() {
    var TableData = new Array();
    $('#Transactions tr').each(function (row, tr) {
        TableData[row] = {
            "id": $(tr).find('td:eq(0)').html()
            , "date": $(tr).find('td:eq(1)').html()
            , "dis": $(tr).find('td:eq(2)').html()
            , "re": $(tr).find('td:eq(3)').html()
            , "pa": $(tr).find('td:eq(4)').html()

        }

    });

    var fTableData = $.toJSON(TableData);
    window.location.href = "views/printTransactions.php?TableData=" + fTableData + "&id=" + $('#aid').val();
}