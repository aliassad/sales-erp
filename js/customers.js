var db;

$(document).ready(function () {
    var url = 'views/gettingCustomers.php';
    $.getJSON(url, function (data) {
        db = TAFFY(data);
        $('#loading').hide();
        if (data == "") {
            $('#vendors').append("<tr class='danger'><td colspan='15'><center><b>No Customers Found !...</b></center></td></tr>");
            return;
        }
        var total_recievable = 0;
        $.each(data, function (index, data) {
            total_recievable += parseFloat(data.total_balance);
            $('#customers').append('<tr onclick="showCustomer(this);" ><td>' + data.id + '</td><td>' + data.customer_no + '</td><td>' + data.name + '</td><td>' + data.company + '</td><td>' + data.uid_no + '</td><td>' + data.account_no + '</td><td>' + data.country + '</td><td>' + data.city + '</td><td>' + data.zip_code + '</td><td>' + data.email + '</td><td>' + data.phone + '</td><td>' + data.telephone + '</td><td>' + data.address + '</td><td>' + data.gst + '</td><td>' + $("#CURRENCY_SIGN").val() + ' ' + parseFloat(data.total_balance).toLocaleString() + '</td></tr>');
        });

        $('#total_Receivable').val($('#CURRENCY_SIGN').val() + " " + parseFloat(total_recievable).toLocaleString());
    });
});

function filter() {

    $('#customers').html("");
    var pid = $('#pno').val();
    var pname = $('#pname').val();
    var pcity = $('#pcity').val();
    var rows;


    if (!pname || pname == "Show all")
        pname = "999";

    if (!pcity || pcity == "Show all")
        pcity = "999";

    var total_recievable = 0;

    if (pid || pname != "999" || pcity != "999") {

        rows = db().filter([{customer_no: {likenocase: pid}}, {name: {likenocase: pname}}, {city: {likenocase: pcity}}]).get();
        if (rows.length == 0) {
            total_recievable = 0;
            $('#customers').append("<tr class='danger' onclick='showCustomer(this);' ><td colspan='15'><center><b>No result" +
                " found..!</b></center></td></tr>");
        } else {
            total_recievable = 0;
            for (var i = 0; i < rows.length; i++) {
                total_recievable += parseFloat(rows[i]['total_balance']);
                $('#customers').append('<tr class="success" onclick="showCustomer(this);" ><td>' + rows[i]['id'] + '</td><td>' + rows[i]['customer_no'] + '</td><td>' + rows[i]['name'] + '</td><td>' + rows[i]['company'] + '</td><td>' + rows[i]['uid_no'] + '</td><td>' + rows[i]['account_no'] + '</td><td>' + rows[i]['country'] + '</td><td>' + rows[i]['city'] + '</td><td>' + rows[i]['zip_code'] + '</td><td>' + rows[i]['email'] + '</td><td>' + rows[i]['phone'] + '</td><td>' + rows[i]['telephone'] + '</td><td>' + rows[i]['address'] + '</td><td>' + rows[i]['gst'] + '</td><td>' + $("#CURRENCY_SIGN").val() + ' ' + parseFloat(rows[i]['total_balance']).toLocaleString() + '</td></tr > ');
            }
        }
    } else {
        total_recievable = 0;
        rows = db().get();
        for (var i = 0; i < rows.length; i++) {
            total_recievable += parseFloat(rows[i]['total_balance']);
            $('#customers').append('<tr onclick="showCustomer(this);" ><td>' + rows[i]['id'] + '</td><td>' + rows[i]['customer_no'] + '</td><td>' + rows[i]['name'] + '</td><td>' + rows[i]['company'] + '</td><td>' + rows[i]['uid_no'] + '</td><td>' + rows[i]['account_no'] + '</td><td>' + rows[i]['country'] + '</td><td>' + rows[i]['city'] + '</td><td>' + rows[i]['zip_code'] + '</td><td>' + rows[i]['email'] + '</td><td>' + rows[i]['phone'] + '</td><td>' + rows[i]['telephone'] + '</td><td>' + rows[i]['address'] + '</td><td>' + rows[i]['gst'] + '</td><td>' + $("#CURRENCY_SIGN").val() + ' ' + parseFloat(rows[i]['total_balance']).toLocaleString() + '</td></tr>');
        }
    }

    $('#total_Receivable').val($('#CURRENCY_SIGN').val() + " " + parseFloat(total_recievable).toLocaleString());


}

function saveCustomer() {

    if (!$('#cname').val()) {
        swal("Input Error", "Please fill all the fields", "error");
        return;
    }

    $.ajax({
        url: "views/addCustomer.php",
        data: {
            name: $('#cname').val(),
            email: $('#cemail').val(),
            phone: $('#cphone').val(),
            address: $('#caddress').val(),
            company: $('#ccompany').val(),
            city: $('#ccity').val(),
            opening_balance: $('#opening_balance').val(),
            country: $('#ccountry').val(),
            zip_code: $('#czip_code').val(),
            uid_no: $('#cuid_no').val(),
            account_number: $('#caccount_number').val(),
            gst: $('#cgst').val(),
            telephone: $('#ctelephone').val(),
            customer_number: $('#ccustomer_number').val(),
        },
        type: "post",
        success: function (msg) {

            if (msg == "true") {
                $('#newCustomerModal').modal('hide');
                swal({
                    title: "Saved!",
                    type: "success",
                    text: "New customer added successfully:)",
                    timer: 2000,
                    showConfirmButton: true
                });
                setTimeout('location.href="index.php?page=customers"', 1500);
            } else {
                swal("Database Error", "Please wait and try Again!", "error");
                return;
            }
        }
    });


}

function clearModal() {
    $('#cname').val('');
    $('#ccustomer_number').val('');
    $('#cphone').val('');
    $('#cemail').val('');
    $('#caddress').val('');
}

function showCustomer(row) {
    var id = row.cells[0].innerHTML;
    window.location.href = "index.php?page=showCustomer&idno=" + id;
}