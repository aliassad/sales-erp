var db;

$(document).ready(function () {



    var url = 'views/gettingmembers.php';
    $.getJSON(url, function (data) {
        db = TAFFY(data);
        $('#loading').hide();
           var i=0;
        $.each(data, function (index, data) {
            i++;
            $('#customers').append('<tr onclick="showCustomer(this);" id="'+ data.id +'" ><td>' + i + '</td><td>' + data.name + '</td><td>' + data.cno + '</td><td>' + data.phone + '</td><td>' + data.address + '</td></tr>');
        });

    });
});

function filter() {

    $('#customers').html("");
    var pid = $('#pno').val();
    var pname = $('#pname').val();
    var rows;


    if (!pname||pname=="Show all")
        pname = "999";


    if (pid || pname != "999") {

        rows = db().filter([{
            cno: {like:pid}
        }, {
            name: {
                likenocase: pname
            }
        }]).get();
        if (rows.length == 0) {
            $('#customers').append("<tr class='danger' onclick='showCustomer(this);' ><td colspan='5'><center><b>No result found..!</b></center></td></tr>");
        } else {
            for (var i = 0; i < rows.length; i++)
                $('#customers').append('<tr class="success" onclick="showCustomer(this);" ><td>' + rows[i]['id'] + '</td><td>' + rows[i]['name'] + '</td><td>' + rows[i]['cno'] + '</td><td>' + rows[i]['phone'] + '</td><td>' + rows[i]['address'] + '</td></tr>');

        }
    } else {
        rows = db().get();
        for (var i = 0; i < rows.length; i++)
            $('#customers').append('<tr onclick="showCustomer(this);" ><td>' + rows[i]['id'] + '</td><td>' + rows[i]['name'] + '</td><td>' + rows[i]['cno'] + '</td><td>' + rows[i]['phone'] + '</td><td>' + rows[i]['address'] + '</td></tr>');
    }


}

function saveCustomer() {

    n = $('#cname').val();
    e = $('#cemail').val();
    p = $('#cphone').val();
    ad = $('#caddress').val();


    if (!$('#cname').val() || !$('#cemail').val()) {
        swal("Input Error", "Please fill all the fields", "error");
        return;
    }

    $.ajax({
        url: "views/addMember.php",
        data: {
            name: n,
            email: e,
            phone: p,
            address: ad
        },
        type: "post",
        success: function (msg) {

            if (msg == "true") {
                $('#newCustomerModal').modal('hide');
                swal({
                    title: "Saved!",
                    type: "success",
                    text: "New Member added successfully:)",
                    timer: 2000,
                    showConfirmButton: true
                });
                setTimeout('location.href="index.php?page=members"', 1500);
            } else {
                swal("Database Error", "Please wait and try Again!", "error");
                return;
            }
        }
    });


}

function clearModal() {

    $('#cname').val('');
    $('#cphone').val('');
    $('#cemail').val('');
    $('#caddress').val('');


}

function showCustomer(row) {
    var id = row.id;
    window.location.href = "index.php?page=showMember&idno=" + id;
}