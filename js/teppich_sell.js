var db;
$(document).ready(function () {

    var url = 'views/gettingTeppichBills.php';
    $.getJSON(url, function (data) {
        db = TAFFY(data);
        var rows = db().get();
        $('#loading').hide();
        if (data == "" || (rows[0]['id'] == null)) {
            $('#bills').append("<tr class='danger'><td colspan='9'><center><b>No Bills Found !...</b></center></td></tr>");
            return;
        }
        for (var i = 0; i < 500; i++)
            $('#bills').append("<tr onclick='showbill(this);'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['bill_serial'] + "</td><td>" + rows[i]['name'] + "</td><td>" + $('#CURRENCY_SIGN').val() + " " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td>" + $('#CURRENCY_SIGN').val() + " " + parseFloat(rows[i]['paid']).toLocaleString() + "</td><td>" + $('#CURRENCY_SIGN').val() + " " + parseFloat(rows[i]['balance']).toLocaleString() + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['ddate'] + "</td><td><span class='btn btn-xs btn-info'>" + rows[i]['type'] + "</span></td></tr>");

    });

});

function toDate(dateStr) {
    var parts = dateStr.split("-");
    return new Date(parts[2], parts[1] - 1, parts[0]);
}

function filter() {

    $('#bills').html("");
    var sid = $('#billno').val();
    var bill_serial = $('#bill_serial').val();
    var sname = $('#customer').val();
    var fdate = $('#fdate').val();
    var tdate = $('#tdate').val();
    var rows;


    if (!sname || sname == "Show all")
        sname = "999";

    if (!bill_serial)
        bill_serial = "999";


    if (sid || bill_serial != "999" || sname != "999" || fdate != "00/00/0000" || tdate != "00/00/0000") {

        if (sid || bill_serial != "999" || sname != "999" || fdate != "00/00/0000" && tdate == "00/00/0000") {

            var flag = false;
            rows = db().get();
            for (var i = 0; i < rows.length; i++) {
                if(rows[i]['bill_serial']) {
                    if (sname == rows[i]['name'] || sid == rows[i]['id'] || ((rows[i]['bill_serial']).includes(bill_serial)!=false) || toDate(fdate).getTime() === toDate(rows[i]['date']).getTime()) {
                        flag = true;
                        $('#bills').append("<tr onclick='showbill(this);' class='success'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['bill_serial'] + "</td><td>" + rows[i]['name'] + "</td><td>" + $('#CURRENCY_SIGN').val() + " " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td>" + $('#CURRENCY_SIGN').val() + " " + parseFloat(rows[i]['paid']).toLocaleString() + "</td><td>" + $('#CURRENCY_SIGN').val() + " " + parseFloat(rows[i]['balance']).toLocaleString() + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['ddate'] + "</td><td><span class='btn btn-xs btn-info'>" + rows[i]['type'] + "</span></td></tr>");
                    }
                } else {
                    if (sname == rows[i]['name'] || sid == rows[i]['id'] || toDate(fdate).getTime() === toDate(rows[i]['date']).getTime()) {
                        flag = true;
                        $('#bills').append("<tr onclick='showbill(this);' class='success'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['bill_serial'] + "</td><td>" + rows[i]['name'] + "</td><td>" + $('#CURRENCY_SIGN').val() + " " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td>" + $('#CURRENCY_SIGN').val() + " " + parseFloat(rows[i]['paid']).toLocaleString() + "</td><td>" + $('#CURRENCY_SIGN').val() + " " + parseFloat(rows[i]['balance']).toLocaleString() + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['ddate'] + "</td><td><span class='btn btn-xs btn-info'>" + rows[i]['type'] + "</span></td></tr>");
                    }
                }

            }

            if (!flag) {
                $('#bills').append("<tr class='danger'><td colspan='9'><center><b>No result found..!</b></center></td></tr>");
            }

            return;
        } else if (fdate != "00/00/0000" && tdate != "00/00/0000" && fdate && tdate) {
            var flag = false;
            rows = db().get();

            var c = 0;
            for (var i = 0; i < rows.length; i++) {
                if (toDate(rows[i]['date']).getTime() >= toDate(fdate).getTime() && toDate(rows[i]['date']).getTime() <= toDate(tdate).getTime()) {
                    flag = true;
                    $('#bills').append("<tr onclick='showbill(this);' class='success'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['bill_serial'] + "</td><td>" + rows[i]['name'] + "</td><td>" + $('#CURRENCY_SIGN').val() + " " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td>" + $('#CURRENCY_SIGN').val() + " " + parseFloat(rows[i]['paid']).toLocaleString() + "</td><td>" + $('#CURRENCY_SIGN').val() + " " + parseFloat(rows[i]['balance']).toLocaleString() + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['ddate'] + "</td><td><span class='btn btn-xs btn-info'>" + rows[i]['type'] + "</span></td></tr>");
                }

            }

            if (!flag) {
                $('#bills').append("<tr class='danger'><td colspan='9'><center><b>No result found..!</b></center></td></tr>");
            }

            return;
        } else {
            rows = db().get();

            var c = 0;
            for (var i = 0; i < 500; i++) {
                $('#bills').append("<tr onclick='showbill(this);'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['bill_serial'] + "</td><td>" + rows[i]['name'] + "</td><td>" + $('#CURRENCY_SIGN').val() + " " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td>" + $('#CURRENCY_SIGN').val() + " " + parseFloat(rows[i]['paid']).toLocaleString() + "</td><td>" + $('#CURRENCY_SIGN').val() + " " + parseFloat(rows[i]['balance']).toLocaleString() + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['ddate'] + "</td><td><span class='btn btn-xs btn-info'>" + rows[i]['type'] + "</span></td></tr>");
            }

        }

    } else {
        rows = db().get();

        var c = 0;
        for (var i = 0; i < 500; i++) {
            $('#bills').append("<tr onclick='showbill(this);'><td>" + rows[i]['id'] + "</td><td>" + rows[i]['bill_serial'] + "</td><td>" + rows[i]['name'] + "</td><td>" + $('#CURRENCY_SIGN').val() + " " + parseFloat(rows[i]['amount']).toLocaleString() + "</td><td>" + $('#CURRENCY_SIGN').val() + " " + parseFloat(rows[i]['paid']).toLocaleString() + "</td><td>" + $('#CURRENCY_SIGN').val() + " " + parseFloat(rows[i]['balance']).toLocaleString() + "</td><td>" + rows[i]['date'] + "</td><td>" + rows[i]['ddate'] + "</td><td><span class='btn btn-xs btn-info'>" + rows[i]['type'] + "</span></td></tr>");
        }

    }


}

function showbill(row) {
    var id = row.cells[0].innerHTML;
    window.location.href = "index.php?page=showTeppichBill&billno=" + id;
}