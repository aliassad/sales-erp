function showVendorReport()
{
    if(!$('#vid').val()||!$('#from').val()||!$('#to').val()||toDate($('#from').val()).getTime()>toDate($('#to').val()).getTime())
    {
        swal("Input Error!","Please fill all required fields","error");
        return;
    }
    setTimeout("location.href='views/vendorReport.php?vname="+$('#vid').val()+"&from="+$('#from').val()+"&to="+$('#to').val()+"'",1000);
}

function toDate(dateStr) {
    var parts = dateStr.split("-");
    return new Date(parts[2], parts[1] - 1, parts[0]);
}
function showCustomerReport()
{
    if(!$('#cid').val()||!$('#cfrom').val()||!$('#cto').val()||toDate($('#cfrom').val()).getTime()>toDate($('#cto').val()).getTime())
    {
        swal("Input Error!","Please fill all required fields","error");
        return;
    }
    setTimeout("location.href='views/customerReport.php?vname="+$('#cid').val()+"&from="+$('#cfrom').val()+"&to="+$('#cto').val()+"'",1000);
}

function showAccountReport()
{
    if(!$('#aid').val()||!$('#afrom').val()||!$('#ato').val()||toDate($('#afrom').val()).getTime()>toDate($('#ato').val()).getTime())
    {
        swal("Input Error!","Please fill all required fields","error");
        return;
    }
    setTimeout("location.href='views/accountReport.php?vname="+$('#aid').val()+"&from="+$('#afrom').val()+"&to="+$('#ato').val()+"'",1000);
}