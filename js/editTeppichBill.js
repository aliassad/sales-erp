var products;
var item = 1; // Adding Dynamic rows in invoice
$(document).ready(function () {
    var i = 2;
    $("#add_row").focus(function () {
        $('#invoice').append("<tr>" +
            "<td class='itemno' style='width:5%;' ></td>" +
            "<td  style='width:28%;'><input id='product" + i + "' placeholder='Product title'  class='form-control' type='text'/></td>" +
            "<td style='width: 7%'><input type='number' id='length" + i + "' placeholder='0 cm' class='form-control' onkeyup='calAmount(this);'></td>" +
            "<td style='width: 7%'><input type='number' id='width" + i + "' placeholder='0 cm' class='form-control' onkeyup='calAmount(this);'></td>" +
            "<td style='width: 8%'><input type='number' id='rate" + i + "' placeholder='@' class='form-control' onkeyup='calAmount(this);'></td>" +
            "<td style='width: 5%'><input type='number' id='sqm" + i + "' placeholder='SQM' class='form-control'  readonly value='0' tabindex='-1' ></td>" +
            "<td style='width: 7%'><input type='number' id='unit" + i + "' placeholder='Qty' class='form-control' onkeyup='calAmount(this);'></td>" +
            "<td style='width: 7%'><input tabindex='-1' type='number' id='disc" + i + "' placeholder='Discount' class='form-control' onkeyup='calAmount(this);'></td>" +
            "<td style='width: 5%'><input type='checkbox' tabindex='-1' id='gst_included" + i + "' class='form-control' readonly value='0' onchange='calAmount(this);'></td>" +
            "<td style='width: 5%'><input type='text' tabindex='-1' id='net" + i + "' placeholder='0' class='form-control net' readonly value='0' ></td>" +
            "<td style='width: 5%'><input type='text' tabindex='-1' id='gst" + i + "' placeholder='0' class='form-control gst' readonly value='0' ></td>" +
            "<td style='width:15%'><input type='number' tabindex='-1' id='amount" + i + "'  class='form-control amt'  placeholder='' value='0' readonly></td>" +
            "<td><button id='" + (i) + "' tabindex='-1' class='btn btn-danger glyphicon glyphicon-remove row-remove' onclick='delete_emp(" + (i) + ");' > </button></td>" +
            "</tr>");
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
    var gst_final_total = 0;
    var net_final_total = 0;
    var length = newrow.cells[2].children[0].value * 1;
    var width = newrow.cells[3].children[0].value * 1;
    var rate = newrow.cells[4].children[0].value;
    var sqm = newrow.cells[5].children[0];
    var nunit = newrow.cells[6].children[0].value;
    var disc = newrow.cells[7].children[0].value;
    var gst_included = newrow.cells[8].children[0].checked;
    var net_total = newrow.cells[9].children[0];
    var gst_amount = newrow.cells[10].children[0];
    var prod = newrow.cells[1].children[0].value;
    if (nunit == "") {
        return;
    }

    var tunit = 0;


    if (rate && nunit) {
        var sqaure_meter = ((length * width) / 10000).toFixed(2);
        sqm.value = sqaure_meter;
        rate = sqaure_meter * rate;
        rate = rate - ((rate * disc) / 100);
        amount = rate * nunit;
        net_total.value = amount;
        newrow.cells[11].children[0].value = (amount).toFixed(2);
    } else {
        newrow.cells[11].children[0].value = 0;
    }

    var amount_section = newrow.cells[11].children[0];
    if (amount_section.value) {
        var gst_total = 0;
        if (gst_included) {
            gst_total = (amount_section.value - (amount_section.value / 1.19)).toFixed(2)
            net_total.value = (amount - gst_total).toFixed(2);
        } else {
            gst_total = ((amount_section.value * 19) / 100).toFixed(2)
            amount_section.value = amount_section.value * 1 + gst_total * 1;
        }
        gst_amount.value = gst_total;
    }

    $('.amt').each(function () {
        var price = $(this).val();
        grandTotal = parseFloat(price) + grandTotal;
    });

    $('.net').each(function () {
        var net_total = $(this).val();
        net_final_total = parseFloat(net_total) + net_final_total;
    });

    $('.gst').each(function () {
        var gst_total = $(this).val();
        gst_final_total = parseFloat(gst_total) + gst_final_total;
    });

    $("#net_total").val(net_final_total.toFixed(2));
    $("#gst_amount").val(gst_final_total.toFixed(2));


    var gross_total = document.getElementById("gross_total");
    gross_total.value = (grandTotal).toFixed(2);
    dis();
}

function calculateTotalWithGST() {
    // var gross_total = $("#gross_total").val();
    // var gst_amount = 0;
    // gst_amount = (parseFloat(gross_total) * 0.19);
    // $('#gst_amount').val((gst_amount).toFixed(2));
    // var net_total = (parseFloat(gross_total) - gst_amount);
    // $('#net_total').val((net_total).toFixed(2));
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
    var final_total = parseFloat($('#gross_total').val()) - parseFloat(final_discount);
    $('#final_total').val((final_total).toFixed(2));
}

//Making JSON Array of Invoice
function storeValues() {
    var TableData = new Array();
    $('#invoice tr').each(function (row, tr) {
        TableData[row] = {
            "no": $(tr).find('td:eq(0)').text()
            , "product": $(tr).find('td:eq(1) > input').val()
            , "length": $(tr).find('td:eq(2) > input').val()
            , "width": $(tr).find('td:eq(3) > input').val()
            , "rate": $(tr).find('td:eq(4) > input').val()
            , "sqm": $(tr).find('td:eq(5) > input').val()
            , "qty": $(tr).find('td:eq(6) > input').val()
            , "discount": $(tr).find('td:eq(7) > input').val()
            , "gst_incl": $(tr).find('td:eq(8) > input[type="checkbox"]').prop('checked')
            , "net": $(tr).find('td:eq(9) > input').val()
            , "gst": $(tr).find('td:eq(10) > input').val()
            , "amount": $(tr).find('td:eq(11) > input').val()
        }
    });
//    TableData.shift();  // first row will be empty - so remove
    return TableData;
}




function saveInvoice() {
    swal({
            title: "Are you sure?",
            text: "You will not be able to recover the Previous Bill !",
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


                var TableData;
                TableData = $.toJSON(storeValues());
                $.ajax({
                    type: "POST",
                    url: "views/editTeppichInvoice.php",
                    data: {
                        type: $('#intitle').val(),
                        notes: $('#notes').val(),
                        customer: $('#customer_name').val(),
                        customer_phone: $('#customer_phone').val(),
                        customer_street: $('#customer_street').val(),
                        customer_post: $('#customer_post').val(),
                        customer_city: $('#customer_city').val(),
                        billid: $('#billidno').val(),
                        duedate: $('#duedate').val(),
                        bdate: $('#billdate').val(),
                        pTableData: TableData,
                        total: $('#gross_total').val(),
                        gst: $('#gst_amount').val(),
                        paid: $('#paid').val(),
                        discount: $('#discount1').val(),
                        balance: $('#final_total').val(),
                        bill_serial: $('#bill_serial').val(),
                        bill_id: $('#invNo').val()
                    },
                    success: function (msg) {
                        swal({
                            title: "Bill Updated & Saved!",
                            type: "success",
                            text: "Successfully :)",
                            timer: 3000,
                            showConfirmButton: false
                        });
                        setTimeout("location.href='index.php?page=editTeppichBill&billno=" + $('#invNo').val() + "'", 3000);
                        return;
                    }
                });


            } else {
                swal({
                    title: "Cancelled",
                    type: "error",
                    text: "Your Bill is not Updated! Bill is safe :)",
                    timer: 1300,
                    showConfirmButton: false
                });
            }
        });

}


//Saving  Invoice in DB with a print.
function saveprintInvoice() {
    saveData();
    setTimeout("location.href='views/printInvoice.php?billid=" + $('#invNo').val() + "'", 1500);
}

//function clearBill()
//{ 
//    $.ajax({
//           type:"POST",
//           url:"views/clearBill.php",
//           data:{billid:$('#invNo').val()},
//           success: function(msg){}
//          });
//
//}