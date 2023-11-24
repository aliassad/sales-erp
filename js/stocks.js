var db;
$(document).ready(function () {

    var url = 'views/gettingProducts.php';
    $.getJSON(url, function (data) {
        db = TAFFY(data);
        if (data == "") {
            $('#products').append("<tr class='danger'><td colspan='16'><center><b>No Products Found !...</b></center></td></tr>");
            return;
        }
        $.each(data, function (index, data) {
            $('#products').append('<tr><td>' + data.id + '</td><td>' + data.s_no + '</td><td>' + data.article_no + '</td><td>' + data.origin + '</td><td>' + data.vendor_no + '</td><td>' + data.item_length + '</td><td>' + data.item_width + '</td><td>' + calculateSquareMeter(data.item_length, data.item_width) + '</td><td>' + data.des + '</td><td>' + data.stock + '</td><td>' + $("#CURRENCY_SIGN").val() + ' ' + parseFloat(data.sprice).toLocaleString() + '</td><td>' + $("#CURRENCY_SIGN").val() + ' ' + parseFloat(data.pprice).toLocaleString() + '</td><td>' + parseFloat(data.disc).toLocaleString() + ' %</td><td>' + data.minstock + '</td><td><a class="btn btn-primary btn-sm" style="padding-bottom:1px;padding-top:1px;"  onclick="editProduct(this);"><i class="fa fa-edit"></i>&nbsp;Edit</a></td><td><a class="btn btn-danger btn-sm" style="padding-bottom:1px;padding-top:1px;"  onclick="deleteProduct(this);"><i class=" fa fa-trash"></i>&nbsp;Delete</a></td></tr>');
        });

    });
});

function filter() {

    $('#products').html("");
    var pid = $('#pno').val();
    var pname = $('#pname').val();
    var rows;


    if (!pname || pname == "Show all")
        pname = "999";
    if (!pid)
        pid = "999";


    if (pid != "999" || pname != "999") {

        rows = db().filter([{s_no: {likenocase: pid}}, {des: {"===": pname}}]).get();
        if (rows.length == 0) {
            $('#products').append("<tr class='danger' ><td colspan='16'><center><b>No result found..!</b></center></td></tr>");
        } else {
            for (var i = 0; i < rows.length; i++)
                $('#products').append('<tr class="success"><td>' + rows[i]['id'] + '</td><td>' + rows[i]['s_no'] + '</td><td>' + rows[i]['article_no'] + '</td><td>' + rows[i]['origin'] + '</td><td>' + rows[i]['vendor_no'] + '</td><td>' + rows[i]['item_length'] + '</td><td>' + rows[i]['item_width'] + '</td><td>' + calculateSquareMeter(rows[i]['item_length'], rows[i]['item_width']) + '</td><td>' + rows[i]['des'] + '</td><td>' + rows[i]['stock'] + '</td><td>' + $("#CURRENCY_SIGN").val() + ' ' + parseFloat(rows[i]['sprice']).toLocaleString() + '</td><td>' + $("#CURRENCY_SIGN").val() + ' ' + parseFloat(rows[i]['pprice']).toLocaleString() + '</td><td>' + parseFloat(rows[i]['disc']).toLocaleString() + ' %</td><td>' + rows[i]['minstock'] + '</td><td><a class="btn btn-primary btn-sm" style="padding-bottom:1px;padding-top:1px;"  onclick="editProduct(this);"><i class="fa fa-edit"></i>&nbsp;Edit</a></td><td><a class="btn btn-danger btn-sm" style="padding-bottom:1px;padding-top:1px;"  onclick="deleteProduct(this);"><i class=" fa fa-trash"></i>&nbsp;Delete</a></td></tr>');

        }
    } else {
        rows = db().get();
        for (var i = 0; i < rows.length; i++)
            $('#products').append('<tr><td>' + rows[i]['id'] + '</td><td>' + rows[i]['s_no'] + '</td><td>' + rows[i]['article_no'] + '</td><td>' + rows[i]['origin'] + '</td><td>' + rows[i]['vendor_no'] + '</td><td>' + rows[i]['item_length'] + '</td><td>' + rows[i]['item_width'] + '</td><td>' + calculateSquareMeter(rows[i]['item_length'], rows[i]['item_width']) + '</td><td>' + rows[i]['des'] + '</td><td>' + rows[i]['stock'] + '</td><td>' + $("#CURRENCY_SIGN").val() + ' ' + parseFloat(rows[i]['sprice']).toLocaleString() + '</td><td>' + $("#CURRENCY_SIGN").val() + ' ' + parseFloat(rows[i]['pprice']).toLocaleString() + '</td><td>' + parseFloat(rows[i]['disc']).toLocaleString() + ' %</td><td>' + rows[i]['minstock'] + '</td><td><a class="btn btn-primary btn-sm" style="padding-bottom:1px;padding-top:1px;"  onclick="editProduct(this);"><i class="fa fa-edit"></i>&nbsp;Edit</a></td><td><a class="btn btn-danger btn-sm" style="padding-bottom:1px;padding-top:1px;"  onclick="deleteProduct(this);"><i class=" fa fa-trash"></i>&nbsp;Delete</a></td></tr>');
    }
}

function calculateSquareMeter(length, width) {
    return (length * width / 10000).toFixed(2);
}

function saveProduct() {

    if (!$('#description').val()) {
        swal("Input Error", "Please enter product name", "error");
        return;
    }

    $.ajax({
        url: "views/addProduct.php",
        type: "POST",
        data: new FormData($('#productForm')[0]),
        contentType: false,
        cache: false,
        processData: false,
        success: function (msg) {
            $("#newProductModal").modal('hide');
            swal({
                title: "Saved!",
                type: "success",
                text: "New Product added successfully:)",
                timer: 2000,
                showConfirmButton: true

            });
            setTimeout('location.href="index.php?page=stock"', 1500);
        }
    });


}

function clearModal() {

    $('#newProductModal').modal('show');
    $('#discrip').val('');
    $('#discrip').focus();
    $('#stock').val('');
    $('#sprice').val('');
    $('#pprice').val('');


}

function deleteProduct(id) {
    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this  Product !",
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
                    text: "Deleting the Product.....",
                    timer: 1200,
                    showConfirmButton: false
                });
                var rid = id.parentNode.parentNode.children[0].innerHTML;
                $.ajax({
                    url: 'views/deleteProduct.php',
                    type: "POST",
                    data: {id: rid},
                    success: function (msg) {
                        var d = id.parentNode.parentNode.rowIndex;
                        document.getElementById('aPa').deleteRow(d);

                    }
                });

                swal({
                    title: "Product Deleted",
                    type: "success",
                    text: "Transaction deleted successfully!",
                    timer: 1200,
                    showConfirmButton: false
                });

            } else {
                swal({
                    title: "Cancelled",
                    type: "error",
                    text: "Your Product is safe :)",
                    timer: 1200,
                    showConfirmButton: false
                });
            }
        });


}

function editProduct(id) {
    $('#product_title').html(id.parentNode.parentNode.children[8].innerHTML);
    $('#edit_product_id').val(id.parentNode.parentNode.children[0].innerHTML);
    $('#edit_serial_no').val(id.parentNode.parentNode.children[1].innerHTML);
    $('#edit_article_no').val(id.parentNode.parentNode.children[2].innerHTML);
    $('#edit_origin').val(id.parentNode.parentNode.children[3].innerHTML);
    let vendor_id = id.parentNode.parentNode.children[4].innerHTML;
    if (vendor_id && vendor_id.split(':')[0]) {
        $('#edit_vendor_id').val(vendor_id.split(':')[0]);
        $('#edit_vendor_id').selectpicker('val', vendor_id.split(':')[0]);
    }
    $('#edit_item_length').val(id.parentNode.parentNode.children[5].innerHTML);
    $('#edit_item_width').val(id.parentNode.parentNode.children[6].innerHTML);
    $('#edit_description').val(id.parentNode.parentNode.children[8].innerHTML);
    $('#edit_stock').val(id.parentNode.parentNode.children[9].innerHTML);
    $('#edit_sprice').val(id.parentNode.parentNode.children[10].innerHTML.replace(/[^0-9\.\-]+/g, ""));
    $('#edit_pprice').val(id.parentNode.parentNode.children[11].innerHTML.replace(/[^0-9\.\-]+/g, ""));
    $('#edit_discount').val(id.parentNode.parentNode.children[12].innerHTML.replace(/[^0-9\.\-]+/g, ""));
    $('#edit_minstock').val(id.parentNode.parentNode.children[13].innerHTML);
    $('#editProductModal').modal('show');
}

function saveEditProduct() {


    if (!$('#edit_description').val()) {
        swal("Input Error", "Please fill Description", "error");
        return;
    }


    $.ajax({
        url: "views/editProduct.php",
        type: "POST",
        data: new FormData($('#editProductForm')[0]),
        contentType: false,
        cache: false,
        processData: false,
        success: function (msg) {
            $("#editStockModal").modal('hide');
            swal({
                title: "Saved!",
                type: "success",
                text: "Product Updated successfully:)",
                timer: 2000,
                showConfirmButton: true

            });
            setTimeout('location.href="index.php?page=stock"', 1500);
        }
    });

}