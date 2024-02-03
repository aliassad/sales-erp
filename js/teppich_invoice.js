$("#cuname").change(function () {
    if ($('#cuname').val().replace(/[^0-9\.\-]+/g, "") == 1) {
        $('#wname').removeAttr("disabled");
        $('#cno').removeAttr("disabled");
        $('#wname').focus();
    } else {
        $('#wname').prop("disabled", true);
        $('#cno').prop("disabled", true);
        $('#product1').focus();
    }

});


var products;
$(document).ready(function () {
    setTimeout(function () {
        $('[data-id="cuname"]').focus();
    }, 1400);
});


var item = 1; // Adding Dynamic rows in invoice
$(document).ready(function () {
    var i = 2;
    $("#add_row").focus(function () {
        $('#invoice').append("<tr><td class='itemno' style='width:5%;' ></td><td  style='width:30%;'><input id='product" + i + "'  class='form-control' type='text'/></td><td><input type='number'  id='rate" + i + "' placeholder='@' class='form-control' onkeyup='calAmount(this);'></td><td><input type='number'  id='unit" + i + "' placeholder='Qty' class='form-control' onkeyup='calAmount(this);'></td><td><input type='number' tabindex='-1'  id='disc" + i + "' placeholder='Discount' class='form-control' onkeyup='calAmount(this);'></td><td><input type='number' tabindex='-1' id='amount" + i + "'  class='form-control amt'  placeholder='' value='0' readonly></td> <td><button id='" + (i) + "' tabindex='-1' class='btn btn-danger glyphicon glyphicon-remove row-remove' onclick='delete_emp(" + (i) + ");' > </button></td></tr>");
        var number = 1;
        $('.itemno').each(function () {
            $(this).html(number);
            number++;
        });
        i++;
        item++;
        dis();
    });


});

function loadProductDetail(id) {
    var prods = products({id: $('#product' + id).val()}).get();
    $('#rate' + id).val(prods[0]['sprice']);
    $('#disc' + id).val(prods[0]['disc']);
    $('#unit' + id).val(1);
    $('#unit' + id).focus();
    $('#unit' + id).keyup();
}

// Deleting rows of invoice 
function delete_emp(id) {
    var grandTotal = 0;

    var row = document.getElementById(id);
    row.parentNode.parentNode.remove(row);
    var number = 1;

    $('.itemno').each(function () {
        $(this).html(number);
        number++;
    });
    $('.amt').each(function () {
        var price = $(this).val();
        grandTotal = parseFloat(price) + grandTotal;
    });

    var gross_total = document.getElementById("gross_total");
    gross_total.value = (grandTotal).toFixed(2);
    dis();

}

//Calculating Grand Total
var flag = true;
var c2 = "";

function calAmount(row) {
    var newrow = row.parentNode.parentNode;
    var amount = 0;
    var grandTotal = 0;
    var length = newrow.cells[2].children[0].value * 1;
    var width = newrow.cells[3].children[0].value * 1;
    var rate = newrow.cells[4].children[0].value;
    var nunit = newrow.cells[5].children[0].value;
    var disc = newrow.cells[6].children[0].value;
    var gst_included = newrow.cells[7].children[0].checked;
    var gst_amount = newrow.cells[8].children[0];
    var prod = newrow.cells[1].children[0].value;
    if (nunit == "") {
        return;
    }

    var tunit = 0;


    if (rate && nunit) {
        var sqaure_meter = ((length * width) / 10000).toFixed(2);
        rate = sqaure_meter * rate;
        rate = rate - ((rate * disc) / 100);
        amount = rate * nunit;
        newrow.cells[9].children[0].value = (amount).toFixed(2);
    } else {
        newrow.cells[9].children[0].value = 0;
    }

    var amount_section = newrow.cells[9].children[0];
    if (amount_section.value) {
        var gst_total = 0;
        if (gst_included) {
            gst_total = ((amount_section.value * 19) / 100).toFixed(2)
        } else {
            gst_total = ((amount_section.value * 19) / 100).toFixed(2)
            amount_section.value = amount_section.value*1 + gst_total*1;
        }
        gst_amount.value = gst_total;
    }

    $('.amt').each(function () {
        var price = $(this).val();
        grandTotal = parseFloat(price) + grandTotal;
    });


    var gross_total = document.getElementById("gross_total");
    gross_total.value = (grandTotal).toFixed(2);
    dis();
}

function calculateTotalWithGST() {
    let invoice_gst = $('#invoice_gst').html();
    var gross_total = $("#gross_total").val();
    var gst_amount = 0;
    if ((invoice_gst * 1) > 0) {
        gst_amount = parseFloat(gross_total) * (parseFloat(invoice_gst) / 100);
        $('#gst_amount').val((gst_amount).toFixed(2));
    } else {
        $('#gst_amount').val(0);
    }

    var net_total = parseFloat(gross_total) + gst_amount;
    $('#net_total').val((net_total).toFixed(2));

}

//Calculating Discount
function dis() {
    var newrow = document.getElementById('discount');
    var grandTotal = 0;
    var paid = newrow.cells[4].children[0].value;
    var dis = newrow.cells[3].children[0].value;
    var final_discount = 0.0;
    // $('.amt').each(function () {
    //     var price = $(this).val();
    //     grandTotal = parseFloat(price) + grandTotal;
    // });
    //
    if (paid && dis) {
        final_discount = parseFloat(paid) + parseFloat(dis);
    } else if (dis) {
        final_discount = dis;
    } else if (paid) {
        final_discount = paid;
    } else {
        final_discount = 0.0;
    }

    calculateTotalWithGST();
    var final_total = parseFloat($('#net_total').val()) - parseFloat(final_discount);
    $('#final_total').val((final_total).toFixed(2));
}

//Making JSON Array of Invoice
function storeValues() {
    var TableData = new Array();
    $('#invoice tr').each(function (row, tr) {
        TableData[row] = {
            "no": $(tr).find('td:eq(0)').text()
            , "product": $(tr).find('td:eq(1)').children().val()
            , "rate": $(tr).find('td:eq(2)').children().val()
            , "unit": $(tr).find('td:eq(3)').children().val()
            , "disc": $(tr).find('td:eq(4)').children().val()
            , "amount": $(tr).find('td:eq(5)').children().val()
        }
    });
//    TableData.shift();  // first row will be empty - so remove
    return TableData;
}


//Saving Invoice in DB
function saveData() {

    var TableData;
    TableData = $.toJSON(storeValues());
    $.ajax({
        type: "POST",
        url: "views/saveInvoice.php",
        data: {
            type: $('#intitle').val(),
            notes: $('#notes').val(),
            customer: $('#cuname').val(),
            wname: $('#wname').val(),
            cno: $('#cno').val(),
            mno: $('#mcno').val(),
            billid: $('#billidno').val(),
            duedate: $('#duedate').val(),
            bdate: $('#billdate').val(),
            pTableData: TableData,
            total: $('#gross_total').val(),
            gst: $('#gst_amount').val(),
            paid: $('#paid').val(),
            discount: $('#discount1').val(),
            balance: $('#final_total').val(),
            billing_company: $('#billing_company').val(),
            bill_serial: $('#bill_serial').val()
        },
        success: function (msg) {
            swal("Bill Saved!", "Successfully", "success");
            return;
        }
    });

}


function saveInvoice() {
    saveData();
    setTimeout("location.href='index.php?page=sell';", 1500);
}

//Saving  Invoice in DB with a print.
function saveprintInvoice() {
    saveData();
    if ($('#wname').val() || $('#cno').val()) {
        setTimeout("location.href='views/printInvoice.php?billid=" + $('#billidno').val() + "&wn=" + $('#wname').val() + "&wno=" + $('#cno').val() + "'", 3000);
    } else
        setTimeout("location.href='views/printInvoice.php?billid=" + $('#billidno').val() + "'", 3000);
}

//Clearing New Customer Modal
function clearModal() {

    $('#cname').val('');
    $('#cphone').val('');
    $('#cemail').val('');
    $('#caddress').val('');


}

function saveCustomer() {

    var n = $('#cname').val();
    var e = $('#cemail').val();
    var p = $('#cphone').val();
    var ad = $('#caddress').val();

    if (!$('#cname').val() || !$('#cemail').val() || !$('#cphone').val() || !$('#caddress').val()) {
        swal("Input Error", "Please fill all the fields", "error");
        return;
    }
    $.ajax({
        url: "views/addCustomer.php",
        data: {name: n, email: e, phone: p, address: ad},
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

                setTimeout('location.href="index.php?page=invoice"', 1500);
            } else {
                swal("Database Error", "Please wait and try Again!", "error");
                return;
            }

        }
    });


}

function loadGST() {
    let selected_customer = ($('#cuname').val()).split(':');
    if (selected_customer[0]) {
        let gst = $('#customer_' + selected_customer[0]).html();
        $('#invoice_gst').html(gst);
    }
    dis();
}

$('#intitle').on('change', function (e) {
    if (this.value == "Order") {
        $('#wname').val("");
        $('#cno').val("");
        $('#wname').prop("disabled", true);
        $('#cno').prop("disabled", true);
    } else {
        $('#wname').removeAttr("disabled", true);
        $('#cno').removeAttr("disabled", true);
    }
});
