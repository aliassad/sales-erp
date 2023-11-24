var db;
$(document).ready(function () {

    var url = 'views/gettingVendors.php';
    $.getJSON(url, function (data) {
        db = TAFFY(data);

        $('#loading').hide();
        var total_payable = 0;
        if (data == "") {
            $('#vendors').append("<tr class='danger'><td colspan='14'><center><b>No Vendors Found !...</b></center></td></tr>");
            return;
        }
        $.each(data, function (index, data) {
            total_payable += parseFloat(data.payment);
            $('#vendors').append('<tr onclick="showEmployee(this);" ><td>' + data.id + '</td><td>' + data.vendor_no + '</td><td>' + data.name + '</td><td>' + data.phone + '</td><td>' + data.country + '</td><td>' + data.city + '</td><td>' + data.zip_code + '</td><td>' + data.uid_no + '</td><td>' + data.account_no + '</td><td>' + data.address + '</td><td>' + data.email + '</td><td>' + data.cname + '</td><td>' + data.gst + '</td><td>' + $("#CURRENCY_SIGN").val() + ' ' + parseFloat(data.payment).toLocaleString() + '</td></tr>');
        });

        $('#total_Payable').val('' + $("#CURRENCY_SIGN").val() + ' ' + parseFloat(total_payable).toLocaleString());

    });
});


function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("eimage").files[0]);
    oFReader.onload = function (oFREvent) {
        document.getElementById("preview").src = oFREvent.target.result;
    };
}


function filter() {

    $('#vendors').html("");
    var pid = $('#eno').val();
    var pname = $('#ename').val();
    var pcity = $('#ecity').val();

    var rows;


    if (!pname || pname == "Show all")
        pname = "999";

    if (!pcity || pcity == "Show all")
        pcity = "999";

    if (!pid)
        pid = "999";

    var total_payable = 0;

    if (pid != "999" || pname != "999" || pcity != "999") {

        rows = db().filter([{vendor_no: {likenocase: pid}}, {name: {"===": pname}}, {city: {"===": pcity}}]).get();
        if (rows.length == 0) {
            total_payable = 0;
            $('#vendors').append("<tr class='danger'><td colspan='14'><center><b>No result found..!</b></center></td></tr>");
        } else {
            total_payable = 0;
            for (var i = 0; i < rows.length; i++) {
                total_payable += parseFloat(rows[i]['payment']);
                $('#vendors').append('<tr class="success" onclick="showEmployee(this);" ><td>' + rows[i]['id'] + '</td><td>' + rows[i]['vendor_no'] + '</td><td>' + rows[i]['name'] + '</td><td>' + rows[i]['phone'] + '</td><td>' + rows[i]['country'] + '</td><td>' + rows[i]['city'] + '</td><td>' + rows[i]['zip_code'] + '</td><td>' + rows[i]['uid_no'] + '</td><td>' + rows[i]['account_no'] + '</td><td>' + rows[i]['address'] + '</td><td>' + rows[i]['email'] + '</td><td>' + rows[i]['cname'] + '</td><td>' + rows[i]['gst'] + '</td><td>' + $("#CURRENCY_SIGN").val() + ' ' + parseFloat(rows[i]['payment']).toLocaleString() + '</td></tr>');
            }
        }


    } else {
        total_payable = 0;
        rows = db().get();
        for (var i = 0; i < rows.length; i++) {
            total_payable += parseFloat(rows[i]['payment']);
            $('#vendors').append('<tr onclick="showEmployee(this);" ><td>' + rows[i]['id'] + '</td><td>' + rows[i]['vendor_no'] + '</td><td>' + rows[i]['name'] + '</td><td>' + rows[i]['phone'] + '</td><td>' + rows[i]['country'] + '</td><td>' + rows[i]['city'] + '</td><td>' + rows[i]['zip_code'] + '</td><td>' + rows[i]['uid_no'] + '</td><td>' + rows[i]['account_no'] + '</td><td>' + rows[i]['address'] + '</td><td>' + rows[i]['email'] + '</td><td>' + rows[i]['cname'] + '</td><td>' + rows[i]['gst'] + '</td><td>' + $("#CURRENCY_SIGN").val() + ' ' + parseFloat(rows[i]['payment']).toLocaleString() + '</td></tr>')
        }
    }


    $('#total_Payable').val($('#CURRENCY_SIGN').val() + " " + parseFloat(total_payable).toLocaleString());

}

function saveEmployee() {

    if (!$("#vname").val()) {
        swal("Input Error!", "Please fill all required fields", "error");
        return;
    }


    $.ajax({
        url: "views/addVendor.php",
        type: "POST",
        data: new FormData($('#vendorForm')[0]),
        contentType: false,
        cache: false,
        processData: false,
        success: function (msg) {
            if (msg == 'true') {
                $('#newEmployeeModal').modal('hide');
                swal({
                    title: "Saved!",
                    type: "success",
                    text: "New Vender is added successfully:)",
                    timer: 2000,
                    showConfirmButton: true
                });
                setTimeout("location.href='index.php?page=vendors'", 2000);
            } else {
                swal("Image file Eroor !", "Image already exist plz change the image or image  name", "error");
                return;

            }

        }
    });


}

function clearModal() {

    $("#vname").val("");
    $('#vphone').val('');
    $('#vemail').val('');
    $('#vaddress').val('');
    $('#vnic').val('');
    $('#vpcompany').val('');

    document.getElementById("preview").src = "img/img.jpg";
    document.getElementById("eimage").value = "";

}

function showEmployee(row) {
    var id = row.cells[0].innerHTML;
    window.location.href = "index.php?page=showVendor&id=" + id;
}


function saveType() {
    var name = $('#hname').val();
    if (!$('#hname').val()) {
        swal('Input Error!', 'Please fill the required field..', 'error');
        return;
    }
    $('#hname').val('');


    $.ajax({
        url: "views/addVendorType.php",
        type: "POST",
        data: {hname: name},
        success: function (msg) {

            if (msg == 'true') {
                $('#newAccountHead').modal('hide');
                setTimeout(function () {
                    "location.href='index.php?page=vendors'"
                }, 2000);

                swal({
                    title: "Saved!",
                    type: "success",
                    text: "New Vendor Type is added successfully:)",
                    timer: 2000,
                    showConfirmButton: false
                });

            } else {
                //  alert(msg);
            }

        }


    });


}


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
                    url: 'views/deleteVendorType.php',
                    type: "POST",
                    data: {rid: rowid},
                    success: function (msg) {
                        // alert(msg);
                        var d = id.parentNode.parentNode.rowIndex;
                        document.getElementById('vtype').deleteRow(d);
                        swal({
                            title: "Data Deleted!",
                            type: "success",
                            text: "Your action is done.",
                            timer: 1200,
                            showConfirmButton: false
                        });
                        setTimeout('location.href="index.php?page=vendors"', 1500);
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



